import { hipodromosBase } from "../stores/hipodromosBase.js";
import type { HipodromosPorTipoResponse, HipodromosResponse } from "../models/NecoHipodromosPorTipoResponse.js";
import { getHipodromosPorTipo } from "./necoHipodromosPorTipo.service.js";

export async function cargarHipodromosDelBackend(token: string, tp_usuario: string): Promise<void>{
    try{
        const data: HipodromosPorTipoResponse[] = await getHipodromosPorTipo(token, tp_usuario);

        const listaPlana: HipodromosResponse[] = data.flatMap(tipo =>
            tipo.paises.flatMap(pais => pais.carreras)
        );

        hipodromosBase.set(listaPlana);
        console.log("Hipodromos base cargados: ", listaPlana);
    } catch(error){
        console.error("Error al cargar hipodromos: ", error);
        
    }
}