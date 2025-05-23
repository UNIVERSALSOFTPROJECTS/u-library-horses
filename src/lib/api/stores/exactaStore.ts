import {writable, type Writable} from 'svelte/store';
import { get } from 'svelte/store';
import type { CaballosSeleccionado } from '../models/ApuestaExactaModel.js';

function createExactaStore(){
    const grupo1 = writable<CaballosSeleccionado[]>([]);
    const grupo2 = writable<CaballosSeleccionado[]>([]);

    return {
        grupo1,
        grupo2,

        toggleCaballo(caballo: CaballosSeleccionado, grupo: 1 | 2){
            const target = grupo === 1 ? grupo1 : grupo2;
            const bu = `${caballo.track}_EX_${caballo.id_caballo}`;
            target.update(lista =>{
                const index = lista.findIndex(c => `${caballo.track}_EX_${caballo.id_caballo}` === bu);
                return index !== -1
                  ?[...lista.slice(0, index), ...lista.slice(index + 1)]
                  : [...lista, caballo];
            });

            console.log(`Grupo ${grupo1}:`, get(target));
            console.log(`Grupo ${grupo2}:`, get(grupo2));
            console.log(`Grupo ${grupo}:`, get(target));
            
            
        },

        limpiar(){
            grupo1.set([]);
            grupo2.set([]);
        },

        generarCombinaciones():[number, number][]{
           
            const g1 = get(grupo1);
            const g2 = get(grupo2);

            const combinaciones: [number, number][] = [];

            for (const a of g1){
                for(const b of g2){
                    if(a.orden_caballo !== b.orden_caballo){
                        combinaciones.push([a.orden_caballo, b.orden_caballo]);
                    }
                }
            }

            return combinaciones;
        },

        generarTextoResumen(): string{
            const g1 = get(grupo1).map(c => c.orden_caballo).join(", ");
            const g2 = get(grupo2).map(c => c.orden_caballo).join(", ");
            return `Grupo 1: ${g1} | Grupo 2: ${g2}`;
        },

        estaSeleccionado(caballo: CaballosSeleccionado, grupo: 1 | 2): boolean{
            const lista = get(grupo === 1 ? grupo1 : grupo2);
            const bu = `${caballo.track}_EX_${caballo.id_caballo}`;

            return lista.some(c => 
                `${caballo.track}_EX_${caballo.id_caballo}` === bu
            )

        }
    }
}

export const exactaStore = createExactaStore();