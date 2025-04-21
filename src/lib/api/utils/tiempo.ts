export function calcularTiempoRestante(fepoch: number): string {
    const ahora = Math.floor(Date.now() / 1000);
  
    // Asegurarse de que fepoch esté en segundos
    if (fepoch > 1e12) fepoch = Math.floor(fepoch / 1000);
  
    const diferencia = fepoch - ahora;
  
    if (diferencia <= 0) return "Ya empezó.";
    if (diferencia > 60) return `${Math.floor(diferencia / 60)} Min`;
    return `${diferencia} Seg`;
  }
  