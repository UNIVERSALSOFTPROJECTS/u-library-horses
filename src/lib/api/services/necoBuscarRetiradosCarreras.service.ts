import type { NecoBuscaRetiradosCarrerasResponse } from "../models/NecoBuscaRetiradosCarrerasResponse.js";

export async function getCarrerasRetiradas(token: string, id_crr: number, tp_usuario: string): Promise<NecoBuscaRetiradosCarrerasResponse[]>{
    const res = await fetch("http://localhost:5000/bff/busca-carreras-retiradas",
        {
            method: "POST",
            headers: {
                token,
                id_crr: String(id_crr),
                tp_usuario,
            },
            body: "{}"
        }
    );

    if(!res.ok){
        const errorText = await res.text();
        throw new Error(`Error ${res.status}: ${errorText}`);
    }

    return await res.json();
}