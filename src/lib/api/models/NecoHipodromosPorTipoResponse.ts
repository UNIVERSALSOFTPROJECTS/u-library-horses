export interface HipodromosPorTipoResponse{
    tipo: number,
    cantidad_tipo: number,
    paises: NecoHipodromosAgrupadosResponse[],
}

export interface NecoHipodromosAgrupadosResponse{
    pais: string,
    cantidad: number, 
    carreras: HipodromosResponse[],
}

export interface HipodromosResponse{
    id_pista: number,
    nombre_pista: string,
    tiempo_restante: number,
    track: string,
    fecha: string,
    fepoch: number,
}