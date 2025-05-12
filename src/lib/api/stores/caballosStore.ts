import { writable } from "svelte/store";

export const caballos = writable<{lista: any[], icr: string | null}>({
    lista: [],
    icr: null
});