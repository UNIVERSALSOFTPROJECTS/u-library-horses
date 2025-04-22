import type { NecoHipodromosActivosResponse } from "../models/NecoHipodromosActivosResponse.js";

export async function getHipodromosActivos(token: string, tp_usuario: string): Promise<NecoHipodromosActivosResponse[]>{
    const res = await fetch("http://localhost:5000/bff/hipodromos-activos",
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