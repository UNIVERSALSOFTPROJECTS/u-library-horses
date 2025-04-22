import { WebSocketServer } from 'ws';
// import si from "systeminformation";
import { data, data2, data3, data4 } from './horses.js';
import { getRacetracksByCountry, getAmountOfRaceByType, countryArray } from './function.js';

const wss = new WebSocketServer({ port: 8081 });

const allData = [data, data2, data3, data4];

// const mensaje = printMessage();

wss.on('connection', function connection(ws) {
    console.log("Conexion established...");

    let index = 0;
    
  ws.on('message', function message(msj) {
    console.log('received: %s', msj);
  });

  ws.send(JSON.stringify({statuss: 'connected', message: 'ws listo'}));
    const intervalId = setInterval(()=>{
        //  ws.send(mensaje);
        //  const mensaje = printMessage();
        //  ws.send(mensaje);
        try{
          //const currentData = JSON.stringify(allData[index]);
           ws.send(JSON.stringify(allData[index]));
          getRacetracksByCountry(allData[index]);
          //ws.send(JSON.stringify(countryArray));
          const raceAmounts = getAmountOfRaceByType();

          const payload = {
            type: 'update',
            data: countryArray,
            raceAmounts: raceAmounts
          }

          ws.send(JSON.stringify(payload));
        } catch(error){
          console.log("ocurrio un error: ", error);
          
          ws.send(JSON.stringify({
            status: 'error',
            message: "error",
          }));
        }
         

        //  const info = {
        //   tempCountryArray: countryArray,
        //   raceAmounts
        //  };

        //  ws.send(JSON.stringify(info));

         index = (index + 1) % allData.length;
       9
    }, 10_000);

    ws.on('close', ()=>{
      clearInterval(intervalId);
      console.log("conexion cerrada");
      
    })
    //  ws.send(ejemplo);
});