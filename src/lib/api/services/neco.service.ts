import type { NecoLoginResponse } from "../models/NecoLoginResponse.js";

export async function loginWithCredential(usr: string, pass: string): Promise<NecoLoginResponse> {
    const res = await fetch("http://localhost:5000/bff/login-dynamic", {
        method: "GET",
        headers: {
            usr,
            pass
        }
    });
 
    if (!res.ok) {
        const errorText = await res.text();
        throw new Error(`Error ${res.status}: ${errorText}`);
    }
 
    return await res.json(); // O res.json() si el backend devuelve JSON
 }
 