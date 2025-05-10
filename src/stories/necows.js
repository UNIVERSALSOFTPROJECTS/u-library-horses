import { get } from "svelte/store";
import { userSession } from "../lib/api/stores/userLogin.js";
import { captureRejectionSymbol } from "ws";

const ws = new WebSocket("wss://bws2.universalrace.net/ws");

const session = get(userSession);
const token = session?.token;
let hipodromosCache = [];

ws.addEventListener("open", () => {

  console.log("✅ Conectado al WebSocket");
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
let carreraSeleccionada = {
  id_pista: null,
  track: null,
};

let mensajependiente = {
  idt: null,
  icr: null,
  tr: null,
  tokens: null,
  cr: null,
}
let enviado = false;

export function enviarDatosSeleccion(id_pista, track){
  carreraSeleccionada.id_pista = id_pista;
  carreraSeleccionada.track = track;
  console.log("Enviando datos seleccionados:", carreraSeleccionada);
}

function intentarEnviarMensaje(){
  const {idt, icr, cr, tr, tokens} = mensajependiente;
  if(!idt || !icr || !cr || !tr || !tokens){
    console.log("No se han completado todos los campos del mensaje.");
    return;
  }

  const mensajePrincipal = {
    type: "event",
    event: "fromUser_LogThisString",
    params: {
      tipo: "ch2",
      tokens,
      idt,
      tr,
      cr,
      icr,
    }
  };
  ws.send(JSON.stringify(mensajePrincipal));
  enviado = true;
  console.log("Mensaje a enviar:", mensajePrincipal);
  
}


ws.addEventListener("message", (event) => {
  const data = JSON.parse(event.data);
  console.log("Recibido:", data);

  if(data.prop === "muestro_hip2_new"){
    try{
      const parsed = JSON.parse(data.value[0]);
      const carrera = parsed.find(c => c.rid_pista === carreraSeleccionada.id_pista);
      if(!carrera)return;
      if(carrera){
        console.log("Carrera es: ", carrera);        
      }
      mensajependiente.idt = carreraSeleccionada.id_pista;
      mensajependiente.icr = carrera.idcrr;
      mensajependiente.tr = carreraSeleccionada.track;
      mensajependiente.tokens = token;
      intentarEnviarMensaje();
      console.log("Mensaje enviado dentro de hip_2_new:", mensajependiente);
    }catch(e){
      console.error("Error al parsear el mensaje:", e);
    }
  }

  if (data.prop === "muestro_hip2") {
    try{
      const parsed = JSON.parse(data.value[0]);

      if(hipodromosCache.length === 0){
        hipodromosCache = parsed;
        console.log("Hipodromos cacheados:", hipodromosCache);
      }
      console.log("mensaje pendiente cr: ", mensajependiente.cr);
      
      if(!mensajependiente.cr && carreraSeleccionada.id_pista){
        try{
            const carrera = hipodromosCache.find(c => c.rid_pista === carreraSeleccionada.id_pista);
            console.log("Carrera encontrada en el cache:", carrera);
            if(carrera){
            mensajependiente.cr = carrera.rcarrera
            intentarEnviarMensaje();
        }
        }catch(e){
          warning("Error al encontrar la carrera en el cache:", e);
        }
        //console.log("Carrera seleccionada para el cache:", carrera);
        //if(carrera){
        //  mensajependiente.cr = carrera.rcarrera
         // intentarEnviarMensaje();
       // }

      }

      console.log("Mensaje enviado dentro de hip_2:", mensajependiente);
    } catch(e){
      console.error("Error al parsear el mensaje:", e);
    }
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
