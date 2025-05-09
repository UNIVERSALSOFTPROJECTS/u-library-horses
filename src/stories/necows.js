// 1. Crear la conexión
const ws = new WebSocket("wss://bws2.miapuesta.vip/ws");

const mensaje_ = {"type":"data",
  "data":"092396fa6a51e09b04910c98cc352af4edd57a8506159374983fe17a996c92f0"}
const mensaje_2 = {"type":"data",
               "data":"500"}

ws.addEventListener('open', function open() {

  console.log("Conexión abierta");

  console.log('ENVIANDO MENSAJE');
	ws.send(JSON.stringify(mensaje_));
	ws.send(JSON.stringify(mensaje_2));
	console.log('MENSAJE ENVIADO');

});

// 2. Al abrir conexión, enviar el mensaje
ws.addEventListener("open", () => {
  console.log("✅ Conectado al WebSocket");

  const payload = {
    type: "event",
    event: "fromUser_LogThisString",
    params: {
      tipo: "ch2",
      tokens: "341788cc8eef985cdeb6f90853b6ff6d7e590ce57f44bdd0b70ade3209c65a23",
      idt: "509",
      cr: "4",
      icr: "1212983",
      tr: "CLCON"
    }
  };

  ws.send(JSON.stringify(payload));
  console.log("🚀 Mensaje enviado:", payload);
});

// 3. Mostrar respuestas
ws.addEventListener("message", (event) => {
  console.log("📨 Respuesta del servidor:", event.data);
});

// 4. Errores
ws.addEventListener("error", (err) => {
  console.error("❌ Error:", err);
});

// 5. Cierre de conexión
ws.addEventListener("close", () => {
  console.warn("🔌 Conexión cerrada");
});
