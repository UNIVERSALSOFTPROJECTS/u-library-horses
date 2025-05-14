import { writable } from "svelte/store";
import type { NecoBuscaRetiradosCarrerasResponse } from "../models/NecoBuscaRetiradosCarrerasResponse.js";

export const carrerasRetiradas = writable<NecoBuscaRetiradosCarrerasResponse[]>([]);