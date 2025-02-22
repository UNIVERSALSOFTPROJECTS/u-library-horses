export function getRacetracksByCountry(data:any){
    let horas:any[] = [];
    
    // var inic=''; -- variable estatica sin uso real
    // var x1,x2,x3=0; -- variables nos utilizadas

    // let racetracks = JSON.parse(data);
    let racetracks = data;
    // console.log("Racetrack: ", racetracks);
    
    // var defau = 0; -- variable sin sentido
    var hipo_selecc_act = '';
    
    if (racetracks.length>1){
        
        //Busco el hipodromo seleccionado actual
        var i = horas.findIndex((x) => x.act === 1);
        console.log("Hipodromo BUSCANDO HIPODROMO SELECIONADO");
        if ( i !== -1 ) {  
            console.log("Hipodromo actual actualizando");
            hipo_selecc_act = horas[i].track;
            console.log("HipoSelect: ", hipo_selecc_act);
            
        }else{
            console.log("No se encontro el hipodromo");
            // console.log(horas);
        }
        
        horas=[];
        horas.length=0;        
        
        var contador1 = 0;
        var contador2 = 0;
        var contador3 = 0;
        
        for (i=0;i<=racetracks.length-1;i++){
            let crrt= (JSON.stringify(racetracks[i].crr_t));
            // console.log("Crrt: ", crrt);
            
            var actual=0;
            if (racetracks[i].rtrack==hipo_selecc_act){
                actual=1;
                console.log("Se encontro el hipodromo que tenia seleccionado el cliente");
            }
            var u={
                htipo:racetracks[i].rtipo,
                track:racetracks[i].rtrack,
                nom:racetracks[i].rnombre,
                crr:racetracks[i].rcarrera,hr:racetracks[i].rhora,
                seg:racetracks[i].falta,
                act:actual,
                crrt:crrt,
                id:racetracks[i].rid_pista,
                fep:racetracks[i].fepoch,
                idcrr:racetracks[i].idcrr,
                pais:racetracks[i].rpais
            };
            horas.push(u);     
            // console.log( "Horas",horas);
                   
            // if (inic===''){ -- variable reduntante
                // x1=racetracks[i].rid_pista;x2=racetracks[i].rtrack;x3=racetracks[i].rcarrera; -- variable no se usa en ninguna funcion
                // inic=racetracks[i].rid_pista; -- esta varible no se envia nunca a una funcion
            // }  
            
            var country=racetracks[i].rpais;
            var trackName=racetracks[i].rnombre;
            var minutesLeft= Math.floor(racetracks[i].falta/60);
            var raceNumber=racetracks[i].rcarrera;
            var raceType = racetracks[i].rtipo;
            var trackId= racetracks[i].rid_pista;
            var radeId= racetracks[i].idcrr;
            var track = racetracks[i].rtrack;

            agrego_hip_pais(country,trackName,minutesLeft,raceNumber,raceType,trackId,radeId,track);
            
            if (racetracks[i].rtipo===1){ // -- esto de aqui sirve para contar la cantidad de caballos, galgos y carretas
                // console.log("tipo1: ", tipo)
                // contador1 = contador1 + tipo;
                // // $("#badge_caballo").html(contador1);
                // console.log("Contador 1", contador1);
                
                // agrego_hip(pais,hipo,ti,crr,tipo,id_tr,id_cr,rtack);
                // agrego_hip_pais(pais,hipo,ti,crr,tipo,id_tr,id_cr,rtack);


                // filtro_pais_prox(pais,hipo,ti,crr,tipo,id_tr,id_cr,rtack);
                            // if (defau===0){ -- esta variable no tiene sentido de existir
                   //$( "#id_hip2_"+id_tr).click();
                            //   defau=1; 
                            // }
                // if (inicial===0){
                    // var i_id_tr=id_tr;
                    // var i_rtack=rtack;
                    // var i_crr = crr;
                    // var i_id_cr=id_cr;
                    // inicial=1;
                // }       -- esta condicional con sus valores no se esta utilizando en ninguna funcion
                        // -- inicial es una variable global

            }
            if(racetracks[i].rtipo===2){
                // console.log("tipo2: ", tipo)
                // contador2 =  contador2 + tipo-1;
                // console.log("Contador 2: ", contador2);
                
                // $("#badge_carretas").html(contador2);
            }
            if(racetracks[i].rtipo===3){
                // console.log("tipo3: ", tipo)
                // contador3 = contador3 + tipo-2;
                // console.log("Contador 3: ", contador3);
                // $("#badge_galgo").html(contador3);
            }
 
        }    
            countryArray = tempCountryArray;

    }
    // console.log("*******************",inicial,i_id_tr);
    // if (inicial===1){
    //     //ver_caballos(i_id_tr,i_rtack,i_crr,i_id_cr);
    //     $('#id_hip2_'+i_id_tr).click();
    //     inicial===2;
    //     //ver_hipo_cerrado_
    // }  
    
    // if (parseInt(ver_hipo_cerrado_)>0){
    //     console.log("monstrando hipodromos cerrados **********"+ver_hipo_cerrado_);
    //     $('#id_hip2_'+ver_hipo_cerrado_).click();
    //     ver_hipo_cerrado_=0;
    // }
    // //ver_caballos_ini(x1,x2,x3,CabD); -- esta funcion no se ubica en ningun archivo
    // viewCountriesRacetrackCache();//mostrar solo races en cache
    // if (race_search.value !== '') { raceSearch(race_search.value); }//continuas tu busqueda normal
    // //$(".loadering").remove(); cuando terminemos todo agregamos esto
}

let tempCountryArray: {
    tipo: number;
    paises: {
      pais: string;
      cantidad: number;
      carreras?: {
        name_pista: any;
        time: number;
        crr: any;
        tipo: any;
        id_pista: any;
        id_crr: any;
        id_track: any;
      }[];
    }[];
  }[] = [
    {tipo: 1, paises: []},
    {tipo: 2, paises: []},
    {tipo: 3, paises: []},
  ];

export let countryArray = tempCountryArray;

function agrego_hip_pais(pais: string, name_pista: any, time: number, crr: any, tipo: any, id_pista: any, id_crr: any, id_track: any) {

    let nuevaCarrera = { name_pista, time, crr, tipo, id_pista, id_crr, id_track };

    let existingType = tempCountryArray.find(entry => entry.tipo === tipo)!;
    
    let existingCountry = existingType.paises.find((entry: { pais: string; cantidad: number; carreras?: any[] }) => entry.pais === pais);

    if(!existingCountry){
        existingType.paises.push({
            pais, 
            cantidad: 1,
            carreras: [nuevaCarrera]
        });
    }
    else{
        existingCountry.carreras = existingCountry.carreras || [];
        existingCountry.carreras.push(nuevaCarrera);
        existingCountry.cantidad++;
    }

    console.log("Country Array:", tempCountryArray);
}


// function agrego_hip_pais(pais: string,name_pista: any,time: number,crr: any,tipo: any,id_pista: any,id_crr: any,id_track: any){

//     let existingType = tempCountryArray.find(tipo: Number; paises:any[]; entry => entry.pais === pais);

//     let nuevaCarrera = {
//         name_pista,
//         time,
//         crr,
//         tipo,
//         id_pista,
//         id_crr,
//         id_track
//     };

//     if(!existingType){
//         tempCountryArray.push({
//             tipo,
//             paises:[{
//                 pais, 
//                 cantidad:1,
//                 carreras: [nuevaCarrera]
//             }]
//         })

//         // existingCountry.cantidad += 1;
//         // existingCountry.carreras = existingCountry.carreras || [];
//         // existingCountry.carreras.push(nuevaCarrera);
//     }else{
//         let existingCountry = existingType.paises.find(entry => entry.pais == pais);
//     }
//     console.log("Country Array:", tempCountryArray);
    // let lpais=pais.toLowerCase();
    // let racetrack=`
    //   <div id="id_hip_${id_pista}" class="racetrack__event racetr" onclick="ver_caballos('${id_pista}','${name_pista}','${id_track}','${crr}','${id_crr}');">
    //     <div class="id_mnu_crr_${id_pista}">${time}</div> 
    //     <div class="name">${name_pista}</div>
    //     <div>R${crr}</div>    
    //   </div>`;
  
    // if ($('#racetrack_'+pais).length <= 0){
    //   let racetrack_collapse = `
    //     <button class="btn racetrack__bycountry" data-bs-toggle="collapse" data-bs-target="#collapse-${pais}" id="racetrack_${pais}">
    //       <img class="racetrack__img" src="${url_imgs}/flags/${lpais}.png" alt="${lpais}-img">
    //       <p>${leng[lpais]}</p>
    //       <span class="racetrack__number" id="cont_${pais}"></span>
    //     </button>
    //     <div class="collapse" id="collapse-${pais}">
    //       <div class="racetrack__event title">
    //         <div class="t_time">${leng["t_time"]}</div>
    //         <div class="t_racetrack">${leng["t_racetrack"]}</div>
    //         <div>#</div> 
    //       </div>
    //       <div id="hip_collapse_${pais}">
    //       </div>
    //     </div>`;
  
    //   let filter_contry = `
    //     <div>
    //       <input type="checkbox" id="filter_country_${pais}" onclick="filterCountryRacetrack('${pais}')">
    //       <label for="filter_country_${pais}">${leng[lpais]}</label>
    //     </div>`; 
  
    //   $('#hip_pais').append(racetrack_collapse);
    //   $('#filter_countries').append(filter_contry);
    // }
    //   $('#hip_collapse_'+pais).append(racetrack);
    //   let count_pais = $('#hip_collapse_'+pais+' div.racetrack__event').length;
    //   $('#cont_'+pais).html(count_pais);
  
  
  