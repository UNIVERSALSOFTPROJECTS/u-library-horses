export interface CrrtListResponse {
    auto: number;
    cerrado: number;
    premiado: number;
    c: string;
    h: number;
    idc: number;
    tap: string;
    tap2: string;
  }
  
  export interface WSMuestroHip2NewResponse {
    id_video: string;
    id_videosd: string;
    id_audio: string;
    resul_: any | null;
    rtipo: number;
    idcrr: number;
    rpais: string;
    fepoch: number;
    rcerrado: number;
    rid_pista: number;
    rnombre: string;
    rtrack: string;
    rcarrera: number;
    rhora: string;
    falta: number;
    crr_t: CrrtListResponse[];
  }
  