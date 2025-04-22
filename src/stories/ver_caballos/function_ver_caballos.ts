import { json } from "@sveltejs/kit";

function getCurrentDate() {
  let date = new Date();
  let dia = date.getDate();
  let mes = date.getMonth() + 1;
  let año = date.getFullYear();
  let current_date = año + '-' + mes + '-' + dia;
  return current_date;
}

async function mostrarprograma(js: { track: string; pais: string; tipo: number }): Promise<void> {
  const Track = js.track;  // Código del hipódromo
  const pais = js.pais;    // País del hipódromo
  const tipo = js.tipo;    // Tipo de evento: 1-Caballos, 2-Carretas, 3-Galgos

  let gaceta: string;

  if (pais === "USA") {
      if (tipo === 1) {
          gaceta = `
              <img onclick="abrir_programa('${Track}',1)" src="./images/iconos/basic.png"/>
              <img onclick="abrir_programa('${Track}',2)" src="./images/iconos/winn.png"/>
              <img onclick="abrir_programa('${Track}',3)" src="./images/iconos/pro.png"/>
          `;
      } else {
          gaceta = `<img onclick="abrir_programa('${Track}',1)" src="./images/iconos/basic.png"/>`;
      }
  } else {
      gaceta = `<img onclick="abrir_programa('${Track}',1)" src="./images/iconos/basic.png"/>`;
  }

  const gacetas = document.getElementById("gacetas");
  if (!gacetas) {
      console.error("No se encontró el elemento #gacetas en el DOM.");
      return;
  }

  try {
      const request = `../../images/programas/${Track}-1.pdf`;
      const response = await fetch(request);

      gacetas.innerHTML = ""; // Limpiar contenido antes de actualizar

      if (response.ok) {
          gacetas.innerHTML = gaceta;
      } else {
          gacetas.innerHTML = "No disponible";
      }
  } catch (error) {
      console.error("Error al cargar el programa:", error);
      gacetas.innerHTML = "Error al cargar el programa";
  }
}


const current_date = getCurrentDate();

export async function verCaballos(id_racetrack:number,name_pista: string,racetrack:string,nrace:number,id_nrace:number, jsonData: any[]){

    console.log("id_racetrack: ", id_racetrack);
    console.log("name_pista:", name_pista);
    console.log("racetrack", racetrack);
    console.log("nrace: ", nrace);
    console.log("id_nrace: ", id_nrace);
    
    let carreras = [];

      console.log("Nrace: ", nrace);
 
        if(nrace!==1){
           carreras = func_resultados_hipodormos(current_date,id_racetrack,'race', true, jsonData);
         }else{

        }
          //busca_caballos(id_racetrack,racetrack,nrace,id_nrace,1);
        
        
    
        
        //func_busca_hipodromos_activos_nuevo(racetrack);
        //busca_pk();
    
}


  //----------------------------------------------------------------------------


  //---------------------------------------------------------------------------

        //FUNC RESULTADOS HIPODORMOS
        function func_resultados_hipodormos(fecha:string,id_pista: number,typeview: string,result: boolean, jsonData:any[]){
          const pista = jsonData.find((track) => track.rid_pista === id_pista);

          if(!pista){
            console.warn(`No se encontró la pista con ID ${id_pista}`)
            return[];
          }

          const carreras = pista.crr_t.map((carrera: {c:string}) => ({
            race: carrera.c,
            st:'',
            id_pista: id_pista,
            fecha: fecha
          }));

          carreras.sort((a:any,b:any) => parseInt(a.race) - parseInt(b.race));

          console.log("Resultados de carreras encontradas: ", carreras);
          return carreras;
          // $.post('controlador.php',{accion:'resultados_hipodromo2',fecha:fecha,id_pista:id_pista}, function(data){
          //     if(data.trim()!==''){
          //         var res = JSON.parse(data);
          //         if (typeof res.error !== 'undefined') {
          //             if (!result) {
          //           mensaje('info','verifique',res.error);
          //             }
          //           return;
          //         }        
          //         if (res.ultimo) muestro_resultados_dividendos2(res.ultimo);
          //         for(var j in res.data){
          //             if (result) {
          //                 let obj = { race:`${ res.data[j].carr}`, st: '',id_pista:id_pista, fecha:fecha};
          //                 btns_all_nraces.push(obj);
                  
          //                 //agregar_selector_carreras(res.data[j].carr,'','',id_pista,fecha,typeview);
          //                 let number_race = `<button class="btn nrace result" onclick="busco_resultados('${res.data[j].carr}','${id_pista}','${fecha}','race')" >${res.data[j].carr}</button>`;
          //                 $('#race_results').append(number_race);
          //             }else{
          //                 console.log("si no exite result yo aparezo");
          //                 muestro_carreras_resultados(res.data[j].carr,res.data[j].id_pista,fecha,typeview);
          //             }
                     
                    
          //         }
             
          //     }else{
          //         alert('error');
          //     }    
         
          //     btns_all_nraces.sort(function(a, b) {
          //       return parseInt(a.race) - parseInt(b.race);
          //     });
          //     console.log("resutladoooooooooooooooo",btns_all_nraces);
       
          // }); 
          
      }
      

          // $.post('controlador.php',{accion:'resultados_hipodromo2',fecha:fecha,id_pista:id_pista}, function(data){
          //     if(data.trim()!==''){
          //         var res = JSON.parse(data);
          //         if (typeof res.error !== 'undefined') {
          //             if (!result) {
          //           mensaje('info','verifique',res.error);
          //             }
          //           return;
          //         }        
          //         if (res.ultimo) muestro_resultados_dividendos2(res.ultimo);
          //         for(var j in res.data){
          //             if (result) {
          //                 let obj = { race:`${ res.data[j].carr}`, st: '',id_pista:id_pista, fecha:fecha};
          //                 btns_all_nraces.push(obj);
                  
          //                 //agregar_selector_carreras(res.data[j].carr,'','',id_pista,fecha,typeview);
          //                 let number_race = `<button class="btn nrace result" onclick="busco_resultados('${res.data[j].carr}','${id_pista}','${fecha}','race')" >${res.data[j].carr}</button>`;
          //                 $('#race_results').append(number_race);
          //             }else{
          //                 console.log("si no exite result yo aparezo");
          //                 muestro_carreras_resultados(res.data[j].carr,res.data[j].id_pista,fecha,typeview);
          //             }
                     
                    
          //         }
             
          //     }else{
          //         alert('error');
          //     }    
         
          //     btns_all_nraces.sort(function(a, b) {
          //       return parseInt(a.race) - parseInt(b.race);
          //     });
          //     console.log("resutladoooooooooooooooo",btns_all_nraces);
       
          // }); 
                           


      async function busco_resultados(carrera: string, id_pista: number, fecha: string, typeview: string) {
        try {
            console.log(`Buscando resultados para Carrera ${carrera} en pista ${id_pista} el ${fecha} (${typeview})`);
    
            const response = await fetch('controlador.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: new URLSearchParams({
                    accion: 'obtener_resultados_carrera',
                    carrera: carrera,
                    id_pista: id_pista.toString(),
                    fecha: fecha
                }).toString()
            });
    
            const data = await response.text();
            if (data.trim() === '') {
                alert('Error: No se encontraron resultados para esta carrera');
                return;
            }
    
            const resultados = JSON.parse(data);
    
            if (resultados.error !== undefined) {
                console.log("Error en la carrera:", resultados.error);
                return;
            }
    
            console.log("Resultados de la carrera:", resultados);
    
            // Aquí puedes actualizar el DOM con los resultados
            const raceResultsContainer = document.getElementById("race_details");
            if (raceResultsContainer) {
                raceResultsContainer.innerHTML = `<p>Resultados de la carrera ${carrera}: ${JSON.stringify(resultados)}</p>`;
            }
        } catch (error) {
            console.error("Error al obtener resultados de la carrera:", error);
        }
    }
    
//---------------------------------------------------------------------------


    //MENSAJE
// function mensaje(icono,titulo,msg){
//   if (titulo == "multiple") {
//     if(icono == "error"){ alert_error.fire({title:msg}); }
//     else if(icono == "warning"){ alert_warning.fire({title:msg}); }
//     else if(icono == "success"){ alert_success.fire({title:msg}); }
//     else{ alert_info.fire({title:msg}); }  
//   }else{
//     if(icono == "error"){ alert_error.fire({title:leng[msg]}); }
//     else if(icono == "warning"){ alert_warning.fire({title:leng[msg]}); }
//     else if(icono == "success"){ alert_success.fire({title:leng[msg]}); }
//     else{ alert_info.fire({title:leng[msg]}); }  
//   }
// }

      //BUSCA CABALLOS
// function busca_caballos(id,tr,cr,idc,sele_crr){
   
//   for (i=0;i<=horas.length-1;i++){
//       horas[i].act=-1;
//   }
  
//   var i = horas.findIndex(x => x.track === tr);
//   if ( i !== -1 ) {
      
//       aplica_apMM(id);
//       crr_act=cr;
//       var t={'tipo':'ch2','tokens':ttokens,'idt':id,'tr':tr,'cr':cr,'icr':idc};
      
//       horas[i].act=1;
//       envia_d(t);                
      
     
//           var json_data = JSON.parse(horas[i].crrt);
//           console.log("dataaaas",json_data);

      
//           for(var j in json_data){
//               var carr = json_data[j].c;
//               var hora = hora_carrera(horaepo(json_data[j].h));
              
//               var status="";                
//               if (cr===json_data[j].c){
//                   /*
//                   if (json_data[j].tap!==''){
//                       var tap = JSON.parse(json_data[j].tap);
//                       if (tap.length>1){
//                           for(var y in tap){
//                               activa_tap(tap[y]);
//                               //$(".ap"+tap[y]).css("display", "list-item");
//                           }
//                       }
//                   }*/
//                   var status="active";
//                   console.log("====z",carr);
//                   agregar_selector_carreras(carr,hora,status);

//                   var fecha_carr=fecha_carrera(horaepo(json_data[j].h));
                  
//                   set_hipodromo(horas[i].nom,hora,fecha_carr,cr);                        
                  
//               }else{
//                  agregar_selector_carreras(carr,hora,status);
//               }         
//               let obj = { race: carr, st: status,id_pista:'', fecha:'' };
//               btns_all_nraces.push(obj);
//           }

            
            

//   }
// }

    //FUNC BUSCA HIPODROMOS ACTIVOS NUEVOS
// function func_busca_hipodromos_activos_nuevo(tr){
//   $('#gacetas').html('');
//   $('#gacetas').append(`<span class="spinner gacetas"></span>`);
//   $.post('controlador.php',{accion:'hipodromos_activos'}, function(data){
      
//       if(data.trim()!==''){
          
//           let hip = JSON.parse(data);
//           if (typeof hip.error !== 'undefined') {
           
//             return;
//           }else{
//               let resultado = hip.find( track => track.track === tr );
//               mostrarprograma(resultado);
//           }        
          
          
//           //muestra_tck_vendido(data);

//       }else{
//           alert('error');
//       }    
//   });    
// }

    //BUSCA PK
// function busca_pk(){
    
//   var cr=crr_act;
//   var i = horas.findIndex(x => x.act === 1);
  
//       if ( i !== -1 ) {
          
//           //$('.n_crr_pk_2').html(parseInt(cr)+1);
//           //$('.n_crr_pk_3').html(parseInt(cr)+2);
//           var t={'tipo':'chpk2','tokens':ttokens,'idt':horas[i].id,'tr':horas[i].track,'cr':cr};
//           envia_d(t);    
          
//       }    
// }
