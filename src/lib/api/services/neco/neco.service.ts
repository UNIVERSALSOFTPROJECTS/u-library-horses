export async function loginWithCredential(usr: string, pass: string) {
    // 1. Hace POST al endpoint /login de tu SvelteKit
    const response = await fetch('/login', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ usr, pass })
    });
  
    // 2. Recoge la respuesta del servidor (de +server.ts)
    const data = await response.json();
  
    // 3. Si falló, lanza error
    if (!response.ok) {
      throw new Error(data.error || 'Error al loguearse');
    }
  
    // 4. Devuelve el resultado si todo salió bien
    return data.message;
  }
  