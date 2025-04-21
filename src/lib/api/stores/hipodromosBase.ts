import { writable } from "svelte/store";
import type { HipodromosResponse } from "../models/NecoHipodromosPorTipoResponse.js";

export const hipodromosBase = writable<HipodromosResponse[]>([]);