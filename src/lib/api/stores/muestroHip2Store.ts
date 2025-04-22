import { writable } from 'svelte/store';
import type { WSMuestroHip2NewResponse } from '../models/WSMuestroHip2NewResponse.js';
export const muestroHip2List = writable<WSMuestroHip2NewResponse[]>([]);
