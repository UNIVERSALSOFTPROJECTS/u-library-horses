import { get } from "svelte/store";
import { userSession } from "../lib/api/stores/userLogin.js";
import { captureRejectionSymbol } from "ws";

const ws = new WebSocket("wss://bws2.universalrace.net/ws");

ws.addEventListener("open", () => {

  console.log("✅ Conectado al WebSocket");
  const session = get(userSession);
  const token = session?.token;
  console.log("usersession dentro de mi WS: ", session);

  const mensaje_ = {
    type: "data",
    data: token,
  };

  const mensaje_2 = {
    type: "data",
    data: "500"
  };

  ws.send(JSON.stringify(mensaje_));
  ws.send(JSON.stringify(mensaje_2));
  console.log("Mensaje enviado:", mensaje_);
  console.log("Mensaje enviado 2:", mensaje_2);
  console.log("🏇🏇Conexión abierta y token enviado:", token);
});

// Al recibir mensajes

let enviado;

let carreraSeleccionada = {
  id_pista: null,
  track: null,
};

export function enviarDatosSeleccion(id_pista, track){
  carreraSeleccionada.id_pista = id_pista;
  carreraSeleccionada.track = track;
  console.log("Enviando datos seleccionados:", carreraSeleccionada);
}


ws.addEventListener("message", (event) => {
  const data = JSON.parse(event.data);
  console.log("Recibido:", data);

  if (data.prop === "muestro_hip2" || data.prop === "muestro_hip2_new") {
    console.log("🧠 Respuesta de handshake, enviando mensaje principal...");
    let parsedArray = [];

    try {
      const firstElement = data.value[0]; // es el string JSON escapado
      parsedArray = JSON.parse(firstElement); // lo convertimos en array real
    } catch (e) {
      console.warn("❌ No se pudo parsear correctamente data.value[0]:", data.value);
      return;
    }


    const carreraEncontrada = parsedArray.find((c) => c.rid_pista === carreraSeleccionada.id_pista);
    if (!carreraEncontrada) {
      console.warn("⚠ No se encontró la carrera con rid_pista:", carreraSeleccionada.id_pista);
      return;
    }

    const session = get(userSession);
    const token = session?.token;

    let mensajePrincipal = {
    type: "event",
    event: "fromUser_LogThisString",
    params: {
      tipo: "ch2",
      tokens: token,
      idt: carreraSeleccionada.id_pista,     // ← ID terminal (puede cambiar) 
      cr: carreraEncontrada.rcarrera,      // ← carrera o nro
      icr: carreraEncontrada.idcrr,    // ← ID de carrera exacta
      tr: carreraSeleccionada.track,       // ← tipo: HIP / GAL / etc.
    }
  };
    ws.send(JSON.stringify(mensajePrincipal));
    console.log("Carrea seleccionada id_pista:", carreraSeleccionada.id_pista);
    console.log("Carrea seleccionada track:", carreraSeleccionada.track);
    console.log("Carrea encontrada rcarrea:", carreraEncontrada.rcarrera);
    console.log("Carrea encontrada idcrr:", carreraEncontrada.idcrr);

    console.log("parsed del websocket", parsedArray);
    
    
  }

  if (data.prop === "cab_hip2") {
    console.log("🏇 Datos de caballos recibidos:");
    console.log(data);
    //console.log("value[0]:", data.value[0]); // los caballos o null
    //console.log("value[1] (icr):", data.value[1]);
  }
});

// Opcional: manejo de errores y cierre
ws.addEventListener("error", (err) => {
  console.error("❌ Error de WebSocket:", err);
});

ws.addEventListener("close", () => {
  console.warn("🔌 WebSocket cerrado");
});
