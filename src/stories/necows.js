import { get } from "svelte/store";
import { userSession } from "../lib/api/stores/userLogin.js";

const ws = new WebSocket("wss://bws2.universalrace.net/ws");

// Este es el mensaje que depende del hipódromo (pista) seleccionado
let mensajePrincipal = {
  type: "event",
  event: "fromUser_LogThisString",
  params: {
    tipo: "ch2",
    tokens: "092396fa6a51e09b04910c98cc352af4edd57a8506159374983fe17a996c92f0",
    idt: "493",     // ← ID terminal (puede cambiar)
    cr: "1",        // ← carrera o nro
    icr: "1214292", // ← ID de carrera exacta
    tr: "HIP"       // ← tipo: HIP / GAL / etc.
  }
};

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

  console.log("🏇🏇Conexión abierta y token enviado:", token);
});

// Al recibir mensajes

let enviado;

ws.addEventListener("message", (event) => {
  const data = JSON.parse(event.data);
  console.log("Recibido:", data);

  if (data.prop === "muestro_hip2" || data.prop === "muestro_hip2_new") {
    console.log("🧠 Respuesta de handshake, enviando mensaje principal...");
    let parsed = {};
    try{
      parsed = JSON.parse(data.value);
    } catch(e){
      console.warn("No se puedo parsear data.value: ", data.value);
      return;
    }
    ws.send(JSON.stringify(mensajePrincipal));
  }

  if (data.prop === "cab_hip2") {
    console.log("🏇 Datos de caballos recibidos:");
    console.log(data);
  }
});

// Opcional: manejo de errores y cierre
ws.addEventListener("error", (err) => {
  console.error("❌ Error de WebSocket:", err);
});

ws.addEventListener("close", () => {
  console.warn("🔌 WebSocket cerrado");
});
