import { writable } from "svelte/store";

export interface UserSession{
    nombre: string,
    token: string,
    tp_usuario: string,
    simbolo: string,
    balance: number,
}

const stored = localStorage.getItem('userSession');
const initial = stored? JSON.parse(stored) as UserSession : null;

export const userSession = writable<UserSession | null>(initial);

userSession.subscribe(value =>{
    if(value){
        localStorage.setItem('userSession', JSON.stringify(value));
    } else{
        localStorage.removeItem('userSession');
    }
})