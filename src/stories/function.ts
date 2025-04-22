let tempCountryArray: {
    tipo: number;
    paises: {
      pais: string;
    //   cantidad: number;
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

export function getRacetracksByCountry(data:any){
    let raceHours:any[] = [];
    tempCountryArray.forEach(entry => entry.paises = [])

    console.log("tempCountryArray", tempCountryArray);
    
    let racetracks = data;
    
    let selectedRacetrack = ''; 
    
    if (racetracks.length>1){
        
        let selectedTrackIndex  = raceHours.findIndex((track) => track.active === 1);
        console.log("Hipodromo BUSCANDO HIPODROMO SELECIONADO");
        if ( selectedTrackIndex  !== -1 ) {  
            console.log("Hipodromo actual actualizando");
            selectedRacetrack = raceHours[selectedTrackIndex ].track;
            console.log("HipoSelect: ", selectedRacetrack);
            
        }else{
            console.log("No se encontro el hipodromo");
        }
        
        raceHours=[];
        raceHours.length=0;        
    
        
        for (selectedTrackIndex =0;selectedTrackIndex <=racetracks.length-1;selectedTrackIndex ++){
            let raceDetails= (JSON.stringify(racetracks[selectedTrackIndex ].crr_t));
            
            let actual=0;
            if (racetracks[selectedTrackIndex ].rtrack==selectedRacetrack){
                actual=1;
                console.log("Se encontro el hipodromo que tenia seleccionado el cliente");
            }
            let raceEntry={
                raceType:racetracks[selectedTrackIndex].rtipo,
                trackCode:racetracks[selectedTrackIndex].rtrack,
                trackName:racetracks[selectedTrackIndex].rnombre,
                raceNumber:racetracks[selectedTrackIndex].rcarrera,
                raceTime:racetracks[selectedTrackIndex ].rhora,
                timeRemaining:racetracks[selectedTrackIndex].falta,
                isActive:actual,
                raceDetails:raceDetails,
                trackId:racetracks[selectedTrackIndex].rid_pista,
                epochTime:racetracks[selectedTrackIndex].fepoch,
                raceId:racetracks[selectedTrackIndex].idcrr,
                country:racetracks[selectedTrackIndex].rpais
            };
            raceHours.push(raceEntry);   
            
            let country=racetracks[selectedTrackIndex].rpais;
            let trackName=racetracks[selectedTrackIndex].rnombre;
            let minutesLeft= Math.floor(racetracks[selectedTrackIndex].falta/60);
            let raceNumber=racetracks[selectedTrackIndex].rcarrera;
            let raceType = racetracks[selectedTrackIndex].rtipo;
            let trackId= racetracks[selectedTrackIndex].rid_pista;
            let radeId= racetracks[selectedTrackIndex].idcrr;
            let track = racetracks[selectedTrackIndex].rtrack;

            agrego_hip_pais(country,trackName,minutesLeft,raceNumber,raceType,trackId,radeId,track);
        }    
            
            countryArray = tempCountryArray;
            console.log("getAmountOfRaceByType", getAmountOfRaceByType());
            console.log("temp:", tempCountryArray)            

    }
}

export function getAmountOfRaceByType(){
    let totalRacesByType = {
        type1: 0,
        type2: 0,
        type3: 0
    };

    for(let typeEntry of countryArray){
        let typeCount = typeEntry.paises.reduce((acc, country) => acc + (country.carreras? country.carreras.length : 0), 0);

        if(typeEntry.tipo === 1){
            totalRacesByType.type1 = typeCount;
        }else if( typeEntry.tipo === 2){
            totalRacesByType.type2 = typeCount;
        }else if(typeEntry.tipo === 3){
            totalRacesByType.type3 = typeCount;
        }
    }
    return totalRacesByType;

}

function agrego_hip_pais(pais: string, name_pista: any, time: number, crr: any, tipo: any, id_pista: any, id_crr: any, id_track: any) {
    
    let nuevaCarrera = { name_pista, time, crr, tipo, id_pista, id_crr, id_track };

    let existingType = tempCountryArray.find(entry => entry.tipo === tipo)!;
    
    let existingCountry = existingType.paises.find((entry: { pais: string; carreras?: any[] }) => entry.pais === pais);

    if(!existingCountry){
        existingType.paises.push({
            pais, 
            // cantidad: 1,
            carreras: [nuevaCarrera]
        });
    }
    else{
        existingCountry.carreras = existingCountry.carreras || [];
        existingCountry.carreras.push(nuevaCarrera);
        // existingCountry.cantidad++;
    }

    
}
  