import type { HipodromosPorTipoResponse } from "../models/NecoHipodromosPorTipoResponse.js";

export async function getHipodromosPorTipo(token: string, tp_usuario: string): Promise<HipodromosPorTipoResponse[]>{
    const res = await fetch("http://localhost:5000/bff/hipodromos-agrupados",
        {
            method: "POST",
            headers: {
                token,
                tp_usuario
            }
        }
    );

    if(!res.ok){
        const errorText = await res.text();
        throw new Error(`Error ${res.status}: ${errorText}`);
    }

    return await res.json();
}