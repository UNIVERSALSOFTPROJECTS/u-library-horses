import { get } from "svelte/store";
import { userSession } from "../lib/api/stores/userLogin.js";
import { captureRejectionSymbol } from "ws";
import { caballos } from "../lib/api/stores/caballosStore.js";
import { carrerasRetiradas } from "../lib/api/stores/carrerasRetiradas.js";
import { getCarrerasRetiradas } from "../lib/api/services/necoBuscarRetiradosCarreras.service.js";
const ws = new WebSocket("wss://bws2.universalrace.net/ws");

let hipodromosCache = [];
let rcarreraAsignada = false;
let enviado = false;

const session = get(userSession);
const token = session?.token;

// Estado de carrera seleccionada
let carreraSeleccionada = {
  id_pista: null,
  track: null,
};

// Mensaje pendiente
let mensajePendiente = {
  idt: null,
  icr: null,
  tr: null,
  tokens: null,
  cr: null,
};

// necows.js (añade o sustituye esta función)
export function seleccionarCarreraPorNP(np) {
  // 1) Busca en el cache de hipódromos
  console.log("🔍 Buscando carrera por NP:", np);
  

  mensajePendiente.cr  = np;

  console.log("mensajePendiente CR actualizado",  mensajePendiente.cr);

  enviarMensajeAlWebSocket();
}
// Función exportada para selección del usuario
export function enviarDatosSeleccion(id_pista, track) {
  carreraSeleccionada = { id_pista, track };
  rcarreraAsignada = false;
  enviado = false;
  mensajePendiente = {
    idt: null,
    icr: null,
    tr: null,
    tokens: null,
    cr: null,
  };

  console.log("🚀 Datos seleccionados:", carreraSeleccionada);

  // Si el hipódromo ya fue cacheado, asigna rcarrera directamente
  const carrera = hipodromosCache.find(h => h.rid_pista === id_pista);
  if (carrera) {
    //mensajePendiente.cr = carrera.rcarrera;
    mensajePendiente = {
      idt: id_pista,
      icr: carrera.idcrr,
      tr: track,
      tokens: token,
      cr: carrera.rcarrera,
    }
    rcarreraAsignada = true;
    console.log("⚡ rcarrera asignado desde cache:", carrera.rcarrera);
    
    //FILTRO PARA CARRERAS RETIRADAS DENTRO DEL WS
    if(carrera.idcrr && session?.tp_usuario)
    {
      getCarrerasRetiradas(token, Number(carrera.idcrr), session.tp_usuario)
      .then((retirados) => {
        carrerasRetiradas.set(retirados);
        console.log("🏇 Carreras retiradas:", retirados);
      })
      .catch((error) => {
        console.error("❌ Error al obtener carreras retiradas:", error);
        carrerasRetiradas.set([]);
      });
    }
    
    enviarMensajeAlWebSocket();
  }
}

// ✅ Envío del mensaje al WebSocket
function enviarMensajeAlWebSocket() {
  const { idt, icr, tr, tokens, cr } = mensajePendiente;
  if (!idt || !icr || !tr || !tokens || !cr) {
    console.log("⚠️ Faltan campos en mensajePendiente:", mensajePendiente);
    return;
  }

  const mensaje = {
    type: "event",
    event: "fromUser_LogThisString",
    params: {
      tipo: "ch2",
      tokens,
      idt,
      tr,
      cr,
      icr,
    },
  };

  ws.send(JSON.stringify(mensaje));
  enviado = true;
  console.log("✅ Mensaje enviado al WS:", mensaje);
}

// ✅ Conexión abierta
ws.addEventListener("open", () => {
  console.log("✅ Conectado al WebSocket");
  console.log("🧾 Usuario:", session);

  ws.send(JSON.stringify({ type: "data", data: token }));
  ws.send(JSON.stringify({ type: "data", data: "500" }));

  console.log("🔐 Token enviado:", token);
});

// ✅ Recepción de mensajes
ws.addEventListener("message", (event) => {
  const data = JSON.parse(event.data);
  console.log("📨 Recibido:", data);

  if (data.prop === "muestro_hip2_new") procesarHip2New(data);
  if (data.prop === "muestro_hip2") procesarHip2(data);
  if (data.prop === "cab_hip2") {
    console.log("🏇 Caballos recibidos:", data.value);
    const listaCaballos = data.value?.[0] || []; 
    const icr = data.value[1];

    const parsedCaballos = JSON.parse(listaCaballos);
    caballos.set({
      lista: parsedCaballos,
      icr: icr,
    })

    console.log("🏇 Caballos procesados:", parsedCaballos);
    console.log("🏇 ICR:", icr);
    
    //console.log("📋 Caballos en Store:", listaCaballos);
  }
});

// 🔍 muestro_hip2_new: rápida, sin rcarrera confiable
function procesarHip2New(data) {
  try {
    const hipodromos = JSON.parse(data.value[0]);
    const carrera = hipodromos.find(h => h.rid_pista === carreraSeleccionada.id_pista);
    if (!carrera) return;

    mensajePendiente.idt = carreraSeleccionada.id_pista;
    mensajePendiente.icr = carrera.idcrr;
    mensajePendiente.tr = carreraSeleccionada.track;
    mensajePendiente.tokens = token;

    console.log("📌 hip2_new procesado:", mensajePendiente);
  } catch (e) {
    console.error("❌ Error al parsear muestro_hip2_new:", e);
  }
}

// 🔍 muestro_hip2: lenta pero confiable para rcarrera
function procesarHip2(data) {
  try {
    const hipodromos = JSON.parse(data.value[0]);

    // Cachear si no está
    if (hipodromosCache.length === 0) {
      hipodromosCache = hipodromos;
      console.log("🗂️ Hipódromos cacheados:", hipodromosCache);
    }

    //if ((!rcarreraAsignada || !mensajePendiente.cr) && carreraSeleccionada.id_pista) {
     if (carreraSeleccionada.id_pista) {
      const carrera = hipodromos.find(h => h.rid_pista === carreraSeleccionada.id_pista);
      if (carrera) {
        mensajePendiente.cr = carrera.rcarrera;
        //rcarreraAsignada = true;
        console.log("📎 rcarrera asignado desde hip2:", carrera.rcarrera);
        if(!enviado){
          enviarMensajeAlWebSocket();
        }
        
      }
    }
  } catch (e) {
    console.error("❌ Error al parsear muestro_hip2:", e);
  }
}

// ❌ Errores y cierre
ws.addEventListener("error", (err) => {
  console.error("❌ Error de WebSocket:", err);
});

ws.addEventListener("close", () => {
  console.warn("🔌 WebSocket cerrado");
});
