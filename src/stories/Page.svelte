<script lang="ts">
  import './page.css';
  import Header from './Header.svelte';
  import 'bootstrap/dist/css/bootstrap.min.css';
  import 'bootstrap/dist/js/bootstrap.bundle.min.js';
  import { data } from './horses.js';  
  import { getRacetracksByCountry, countryArray } from './function.js';
  import './main.scss';
  import { caballos } from '../lib/api/stores/caballosStore.js';
  import { derived } from 'svelte/store';
  let user = $state<{ name: string }>();
  getRacetracksByCountry(data);
  const caballosList = derived(caballos, (v) => v ?? {lista: [], icr: 0});
  let selectedPista: {id_pista: number; track:string} = {id_pista: 0, track: ''};
  //let startICR: number = null;
  //CONEXION DEL WEBSOCKET DESDE EL FRONTEND
  import { enviarDatosSeleccion, seleccionarCarreraPorNP } from './necows.js';
  //SERVICES
  import { carrerasRetiradas } from '../lib/api/stores/carrerasRetiradas.js';
  import { getHipodromosPorTipo } from '../lib/api/services/necoHipodromosPorTipo.service.js';
  import { getCarrerasRetiradas } from '../lib/api/services/necoBuscarRetiradosCarreras.service.js';
  import type { HipodromosPorTipoResponse } from '../lib/api/models/NecoHipodromosPorTipoResponse.js';
  import { userSession } from '../lib/api/stores/userLogin.js';
  import { onMount } from 'svelte';
	import NavbarComponent from './NavbarComponent.svelte';
  import { get } from 'svelte/store';

  let hipodromos= $state<HipodromosPorTipoResponse[]>([]);
  let errorCarga = $state('')

  onMount(async () =>{
      if($userSession){
        try{
          hipodromos = await getHipodromosPorTipo($userSession.token, $userSession.tp_usuario);
          console.log('Hipodromos activos: ', hipodromos);
          console.log('Guardando en store:', ($userSession.token, $userSession.tp_usuario));
        } catch(err){
          errorCarga = 'Error alobtener lo hipodromos... :c';
          console.log(err);
          
        }
      } else{
        errorCarga = 'no hay sesion activa';
        console.warn('No se encontro sesion.');
        
      }
  })
  
  let cantidadCaballos = $derived(() => hipodromos.find(h => h.tipo === 1)?.cantidad_tipo ?? 0);
  let cantidadGalgos = $derived(() => hipodromos.find(h => h.tipo === 2)?.cantidad_tipo ?? 0);
  let cantidadCarretas = $derived(() => hipodromos.find(h => h.tipo === 3)?.cantidad_tipo ?? 0);
  let tipoSeleccionado = $state<number>(1); // Por defecto: 1 = caballos

  // CALCULAR TIEMPO RESTANTE
  import { writable } from 'svelte/store';
  import { calcularTiempoRestante } from '../lib/api/utils/tiempo.js';
	import { cargarHipodromosDelBackend } from '../lib/api/services/hipodromosService.js';
	import { hipodromosBase } from '../lib/api/stores/hipodromosBase.js';

  const tiempos = writable<{ [id_pista: number]: string }>({});
  let intervalo: any;

  function iniciarTemporizador() {
  intervalo = setInterval(() => {
    const nuevosTiempos: { [id_pista: number]: string } = {};

    hipodromos.forEach(h => {
      h.paises?.forEach(p => {
        p.carreras?.forEach(c => {
          nuevosTiempos[c.id_pista] = calcularTiempoRestante(c.fepoch);
        });
      });
    });

    tiempos.set(nuevosTiempos);
  }, 1000);
}



onMount(() => {
  iniciarTemporizador();
  console.log("Caballos del ws dende Page.svelte: ", caballos);
});

// UNION DE HIPODROMOS ENDPOINT Y WEBSOCKET
onMount(async() =>{
  const session = get(userSession);
  if(session?.token && session?.tp_usuario){
    try{
      await cargarHipodromosDelBackend(session.token, session.tp_usuario);
      const hipos = get(hipodromosBase);
      console.log("Test: hipodromos contienen: ", hipos);
      
    } catch(error){
      console.error("Error probando cargarHipodromos del Backend: ", error);
      
    }
  } else{
    console.warn('No hay wesion activa para testear hipodromos base.');
  }
  console.log("Caballos del ws dende Page.svelte: ", caballos);
})

function mu_slip_ex(idc:string, cbn: number, p: number, track: string){
  console.log({idc, cbn, p, track});
}

import type { CaballosSeleccionado } from '../lib/api/models/ApuestaExactaModel.js';
import { exactaStore } from '../lib/api/stores/exactaStore.js';

function seleccionarCaballo(caballoData: any, orden: number, posicion: 1 | 2, track: string){
  const caballo: CaballosSeleccionado = {
    id_caballo: caballoData.id,
    orden_caballo: orden,
    posicion: posicion,
    track: caballoData.track,
  };
  exactaStore.toggleCaballo(caballo, posicion);
}

function estaMarcado(caballoData: any, orden: number, posicion: 1 | 2, track:string): boolean{
  return exactaStore.estaSeleccionado({
    id_caballo: caballoData.id,
    orden_caballo: orden,
    posicion: posicion,
    track: track,
  }, posicion)
}
</script>
<NavbarComponent></NavbarComponent>
<div class="uhorses" >
  <!-- <Header></Header> -->
  <div class='main'>
    <section>
      <!-- comienza el seccion de left -->
    <section class='main__left'>
          <div class="" >
            <!-- DIV PARA CABALLOS -->
            <div 
              class="btn race {tipoSeleccionado === 1 ? 'active' : ''}"
              on:click={() => tipoSeleccionado = 1}
              on:keydown={(e) => (e.key === "Enter" || e.key === '') && (tipoSeleccionado = 1)}
              role="button"
              tabindex="0" >
              <span id="badge_caballo">{cantidadCaballos()}</span>
              <img src="https://www.universalhorse.club/img/iconos/caballos001.png" alt="">
            </div>
            
            <!-- DIV PARA GALGOS -->
            <div 
              class="btn race {tipoSeleccionado === 2 ? 'active' : ''}"
              on:click={() => tipoSeleccionado = 2}
              on:keydown={(e) => (e.key === "Enter" || e.key === '') && (tipoSeleccionado = 2)}
              role="button"
              tabindex="0">
              <span id="badge_galgo">{cantidadGalgos()}</span>
              <img src="https://www.universalhorse.club/img/iconos/galgo01.png" alt="">
            </div>
            
            <div class="btn race 
              {tipoSeleccionado === 3 ? 'active' : ''}"
              on:click={() => tipoSeleccionado = 3}
              on:keydown={(e) => (e.key === "Enter" || e.key === '') && (tipoSeleccionado = 3)}
              role="button"
              tabindex="0">
              <span id="badge_carretas">{cantidadCarretas()}</span>
              <img src="https://www.universalhorse.club/img/iconos/carreta01.png" alt="">
            </div>
            
            <div class="btn race" ><img src="https://www.universalhorse.club/img/iconos/jackpolla01.png" alt=""></div>
            <div class="btn race" ><img src="https://www.universalhorse.club/img/iconos/reloj01.png" alt=""><div ></div></div>
            <div class="btn race" ><img src="https://www.universalhorse.club/img/iconos/caballos_retirado.png" alt=""><div >Retirados</div></div>
            <div class="btn race" ><img src="https://www.universalhorse.club/img/iconos/resultados.png" alt=""><div >Programas</div></div>
            <div class="btn race" ><img src="https://www.universalhorse.club/img/iconos/engranaje01.png" alt=""><div >Resultados</div></div>
            <div class="btn race" ><img src="https://www.universalhorse.club/img/iconos/engranaje01.png" alt=""></div>
          </div>

          <div class="" >

            <input type="search" class="ipt search t_srch-race" id="race_search" placeholder="Race search" autocomplete="off">
     
            <div class="dropdown" >
              <button class="btn filter t_fl-countries" type="button" data-bs-toggle="dropdown" data-bs-auto-close="outside">Filter countries</button>
              <div class="dropdown-menu" >
                <div class="filter__countries" id="filter_countries" >
    </div>
              </div>
            </div>
             
            <!-- comienza el div de paises x carrera  -->
            {#each hipodromos.filter(h => h.tipo === tipoSeleccionado) as tipoData}
            <div class="racetrack" id="hip_pais">
              
              {#each tipoData.paises as country, countryIndex}
      <button class="btn racetrack__bycountry" data-bs-toggle="collapse" data-bs-target={`#collapse${countryIndex}`} id="racetrack_CHL" style="" aria-controls={`collapse${countryIndex}`}>
        <img class="racetrack__img" src="https://d2zzz5z45zl95g.cloudfront.net/usr_imgs/flags/{country.pais.toLowerCase()}.png" alt="chl-img">
        <p>{country.pais}</p>
        <span class="racetrack__number" id="cont_CHL">{country.cantidad}</span>
      </button>
      <div class="collapse" id={`collapse${countryIndex}`}>
        <div class="racetrack__event title" >
          <div class="t_time" >Time</div>
          <div class="t_racetrack" >Racetrack</div>
          <div >#</div> 
        </div>
        <div id="hip_collapse_CHL" >
        
          <!-- comienza div de carreras  -->
          {#each (country.carreras ??[] ) as carrera, raceIndex(carrera.id_pista || raceIndex)}
    <div id="id_hip_{countryIndex}_{raceIndex}" class="racetrack__event racetr" on:click={() => enviarDatosSeleccion(carrera.id_pista, carrera.track)}>
      <div class="id_mnu_crr_{carrera.id_pista}_{carrera.track}">
        {$tiempos[carrera.id_pista] ?? '...'}
      </div>  
      <div class="name" >{carrera.nombre_pista}</div>
      <div >R##</div> 
    </div>
    {/each}
    <!-- termina div de carreras  -->
  </div>
      </div>
     {/each}
      </div>
      {/each}
      <!-- termina el div de pais y carrera x pais  -->
    </div>

          
        <!-- </div> -->
    </section>
    <!-- termina el section de left -->

    <div class="limit" >
          <div class="limit-title" >Limite de apuestas(USD )</div>
          <div class="limit-ap">
            <div class="nombre_hipodromo" >Penn National</div>
            <div class="t_race" >Race</div>
            <div class="carrera_actual" >1</div>
            <div >W/P/S</div>
            <div id="minapwps" >10</div>
            <div id="maxapwps" >100</div>
            <div >Exotica</div>
            <div id="minapexo" >20</div>
            <div id="maxapexo" >200</div>
          </div>
          <div class="limit-footer" >
            <div  >Monto máximo de pago por carrera:</div>
            <div >0.00</div>
          </div>
        </div>
    </section>
    <!-- termina el section de left2 -->
    
    <section class='main__center'>
<!-- <div class="panel__center" bis_skin_checked="1"> -->
        <div class="upcoming__title" ><i class="fa-regular fa-clock"></i> <span class="t_upc-races">Upcoming races</span></div>
        <div class="upcoming__races" id="upcoming_races" >
        <div id="id_hip2_23" class="upcoming__race USA" style="">
          <img class="upcoming__img" src="https://d2zzz5z45zl95g.cloudfront.net/usr_imgs/flags/usa.png" alt="usa-img">
          <p class="upcoming__racetrack">Tampa Bay Downs R2</p>
          <p class="pulse">To start</p>
          <p>Pure blood</p>
        </div>
    
        <div id="id_hip2_22" class="upcoming__race USA" style="">
          <img class="upcoming__img" src="https://d2zzz5z45zl95g.cloudfront.net/usr_imgs/flags/usa.png" alt="usa-img">
          <p class="upcoming__racetrack">Gulfstream Park R2</p>
          <div class="id_mnu_crr_22">6 Min</div>
          <p>Pure blood</p>
        </div>
    
        <div id="id_hip2_553" class="upcoming__race CHL" style="">
          <img class="upcoming__img" src="https://d2zzz5z45zl95g.cloudfront.net/usr_imgs/flags/chl.png" alt="chl-img">
          <p class="upcoming__racetrack">Club Hipico Santiago R8</p>
          <div class="id_mnu_crr_553">6 Min</div>
          <p>Pure blood</p>
        </div>
    
        <div id="id_hip2_552" class="upcoming__race ARG" style="">
          <img class="upcoming__img" src="https://d2zzz5z45zl95g.cloudfront.net/usr_imgs/flags/arg.png" alt="arg-img">
          <p class="upcoming__racetrack">Hipodromo de Palermo R1</p>
          <div class="id_mnu_crr_552" >12 Min</div>
          <p>Pure blood</p>
        </div>
    
        <div id="id_hip2_40" class="upcoming__race USA" style="">
          <img class="upcoming__img" src="https://d2zzz5z45zl95g.cloudfront.net/usr_imgs/flags/usa.png" alt="usa-img">
          <p class="upcoming__racetrack">Laurel Park R2</p>
          <div class="id_mnu_crr_40" >12 Min</div>
          <p>Pure blood</p>
        </div>
    
        <div id="id_hip2_241" class="upcoming__race URU" style="">
          <img class="upcoming__img" src="https://d2zzz5z45zl95g.cloudfront.net/usr_imgs/flags/uru.png" alt="uru-img">
          <p class="upcoming__racetrack">URU Las Piedras R1</p>
          <div class="id_mnu_crr_241" >12 Min</div>
          <p>Pure blood</p>
        </div>
    
        <div id="id_hip2_400" class="upcoming__race ENG" style="">
          <img class="upcoming__img" src="https://d2zzz5z45zl95g.cloudfront.net/usr_imgs/flags/eng.png" alt="eng-img">
          <p class="upcoming__racetrack">UK Southwell R3</p>
          <div class="id_mnu_crr_400" >12 Min</div>
          <p>Pure blood</p>
        </div>
    
        <div id="id_hip2_24" class="upcoming__race USA" style="">
          <img class="upcoming__img" src="https://d2zzz5z45zl95g.cloudfront.net/usr_imgs/flags/usa.png" alt="usa-img">
          <p class="upcoming__racetrack">Aqueduct R1</p>
          <div class="id_mnu_crr_24" >24 Min</div>
          <p>Pure blood</p>
        </div>
    
        <div id="id_hip2_330" class="upcoming__race SAF" style="">
          <img class="upcoming__img" src="https://d2zzz5z45zl95g.cloudfront.net/usr_imgs/flags/saf.png" alt="saf-img">
          <p class="upcoming__racetrack">SAF Greyville R7</p>
          <div class="id_mnu_crr_330" >27 Min</div>
          <p>Pure blood</p>
        </div>
    
        <div id="id_hip2_397" class="upcoming__race IRE" style="">
          <img class="upcoming__img" src="https://d2zzz5z45zl95g.cloudfront.net/usr_imgs/flags/ire.png" alt="ire-img">
          <p class="upcoming__racetrack">IRE Dundalk R5</p>
          <div class="id_mnu_crr_397" >27 Min</div>
          <p>Pure blood</p>
        </div>
    
        <div id="id_hip2_3" class="upcoming__race PR" style="">
          <img class="upcoming__img" src="https://d2zzz5z45zl95g.cloudfront.net/usr_imgs/flags/pr.png" alt="pr-img">
          <p class="upcoming__racetrack">Camarero Race Track R1</p>
          <div class="id_mnu_crr_3" >29 Min</div>
          <p>Pure blood</p>
        </div>
    
        <div id="id_hip2_26" class="upcoming__race USA" style="">
          <img class="upcoming__img" src="https://d2zzz5z45zl95g.cloudfront.net/usr_imgs/flags/usa.png" alt="usa-img">
          <p class="upcoming__racetrack">Oaklawn Park R1</p>
          <div class="id_mnu_crr_26" >44 Min</div>
          <p>Pure blood</p>
        </div>
    
        <div id="id_hip2_25" class="upcoming__race USA" style="">
          <img class="upcoming__img" src="https://d2zzz5z45zl95g.cloudfront.net/usr_imgs/flags/usa.png" alt="usa-img">
          <p class="upcoming__racetrack">Fair Grounds R1</p>
          <div class="id_mnu_crr_25" >59 Min</div>
          <p>Pure blood</p>
        </div>
    
        <div id="id_hip2_9" class="upcoming__race USA" style="">
          <img class="upcoming__img" src="https://d2zzz5z45zl95g.cloudfront.net/usr_imgs/flags/usa.png" alt="usa-img">
          <p class="upcoming__racetrack">Louisiana Downs R1</p>
          <div class="id_mnu_crr_9" >79 Min</div>
          <p>Pure blood</p>
        </div>
    
        <div id="id_hip2_34" class="upcoming__race USA"  style="">
          <img class="upcoming__img" src="https://d2zzz5z45zl95g.cloudfront.net/usr_imgs/flags/usa.png" alt="usa-img">
          <p class="upcoming__racetrack">Sunland Park R1</p>
          <div class="id_mnu_crr_34" >99 Min</div>
          <p>Pure blood</p>
        </div>
    
        <div id="id_hip2_31" class="upcoming__race USA"  style="">
          <img class="upcoming__img" src="https://d2zzz5z45zl95g.cloudfront.net/usr_imgs/flags/usa.png" alt="usa-img">
          <p class="upcoming__racetrack">Santa Anita R1</p>
          <div class="id_mnu_crr_31" >164 Min</div>
          <p>Pure blood</p>
        </div>
    
        <div id="id_hip2_21" class="upcoming__race USA" style="">
          <img class="upcoming__img" src="https://d2zzz5z45zl95g.cloudfront.net/usr_imgs/flags/usa.png" alt="usa-img">
          <p class="upcoming__racetrack">Delta Downs R1</p>
          <div class="id_mnu_crr_21">304 Min</div>
          <p>Pure blood</p>
        </div>
    
        <div id="id_hip2_27" class="upcoming__race USA" style="">
          <img class="upcoming__img" src="https://d2zzz5z45zl95g.cloudfront.net/usr_imgs/flags/usa.png" alt="usa-img">
          <p class="upcoming__racetrack">Turfway Park R1</p>
          <div class="id_mnu_crr_27" >309 Min</div>
          <p>Pure blood</p>
        </div>
    
        <div id="id_hip2_388" class="upcoming__race NZ"  style="">
          <img class="upcoming__img" src="https://d2zzz5z45zl95g.cloudfront.net/usr_imgs/flags/nz.png" alt="nz-img">
          <p class="upcoming__racetrack">New Zealand Ellerslie R1</p>
          <div class="id_mnu_crr_388" >337 Min</div>
          <p>Pure blood</p>
        </div>
    
        <div id="id_hip2_456" class="upcoming__race NZ"  style="">
          <img class="upcoming__img" src="https://d2zzz5z45zl95g.cloudfront.net/usr_imgs/flags/nz.png" alt="nz-img">
          <p class="upcoming__racetrack">New Zealand Plymouth R1</p>
          <div class="id_mnu_crr_456" >352 Min</div>
          <p>Pure blood</p>
        </div>
    
        <div id="id_hip2_4" class="upcoming__race USA"  style="">
          <img class="upcoming__img" src="https://d2zzz5z45zl95g.cloudfront.net/usr_imgs/flags/usa.png" alt="usa-img">
          <p class="upcoming__racetrack">Charles Town R1</p>
          <div class="id_mnu_crr_4" >374 Min</div>
          <p>Pure blood</p>
        </div>
    
        <div id="id_hip2_585" class="upcoming__race JPN" >
          <img class="upcoming__img" src="https://d2zzz5z45zl95g.cloudfront.net/usr_imgs/flags/jpn.png" alt="jpn-img">
          <p class="upcoming__racetrack">JPN Tokyo City R1</p>
          <div class="id_mnu_crr_585" >444 Min</div>
          <p>Pure blood</p>
        </div>
    
        <div id="id_hip2_588" class="upcoming__race AUS"  style="">
          <img class="upcoming__img" src="https://d2zzz5z45zl95g.cloudfront.net/usr_imgs/flags/aus.png" alt="aus-img">
          <p class="upcoming__racetrack">Sandown AUS R1</p>
          <div class="id_mnu_crr_588">449 Min</div>
          <p>Pure blood</p>
        </div>
    
        <div id="id_hip2_231" class="upcoming__race AUS" style="">
          <img class="upcoming__img" src="https://d2zzz5z45zl95g.cloudfront.net/usr_imgs/flags/aus.png" alt="aus-img">
          <p class="upcoming__racetrack">Townsville R1</p>
          <div class="id_mnu_crr_231">453 Min</div>
          <p>Pure blood</p>
        </div>
    
        <div id="id_hip2_211" class="upcoming__race AUS" style="">
          <img class="upcoming__img" src="https://d2zzz5z45zl95g.cloudfront.net/usr_imgs/flags/aus.png" alt="aus-img">
          <p class="upcoming__racetrack">Rosehill R1</p>
          <div class="id_mnu_crr_211" >464 Min</div>
          <p>Pure blood</p>
        </div>
    
        <div id="id_hip2_600" class="upcoming__race AUS" style="">
          <img class="upcoming__img" src="https://d2zzz5z45zl95g.cloudfront.net/usr_imgs/flags/aus.png" alt="aus-img">
          <p class="upcoming__racetrack">Morphettville R1</p>
          <div class="id_mnu_crr_600">491 Min</div>
          <p>Pure blood</p>
        </div>
    
        <div id="id_hip2_477" class="upcoming__race AUS" style="">
          <img class="upcoming__img" src="https://d2zzz5z45zl95g.cloudfront.net/usr_imgs/flags/aus.png" alt="aus-img">
          <p class="upcoming__racetrack">Kyneton R1</p>
          <div class="id_mnu_crr_477">495 Min</div>
          <p>Pure blood</p>
        </div>
    
        <div id="id_hip2_180" class="upcoming__race AUS"  style="">
          <img class="upcoming__img" src="https://d2zzz5z45zl95g.cloudfront.net/usr_imgs/flags/aus.png" alt="aus-img">
          <p class="upcoming__racetrack">AUS Doomben R1</p>
          <div class="id_mnu_crr_180" >507 Min</div>
          <p>Pure blood</p>
        </div>
    
        <div id="id_hip2_181" class="upcoming__race AUS"  style="">
          <img class="upcoming__img" src="https://d2zzz5z45zl95g.cloudfront.net/usr_imgs/flags/aus.png" alt="aus-img">
          <p class="upcoming__racetrack">AUS Newcastle R1</p>
          <div class="id_mnu_crr_181" >519 Min</div>
          <p>Pure blood</p>
        </div>
    
        <div id="id_hip2_266" class="upcoming__race AUS"  style="">
          <img class="upcoming__img" src="https://d2zzz5z45zl95g.cloudfront.net/usr_imgs/flags/aus.png" alt="aus-img">
          <p class="upcoming__racetrack">Sapphire Coast R1</p>
          <div class="id_mnu_crr_266" >545 Min</div>
          <p>Pure blood</p>
        </div>
    
        <div id="id_hip2_178" class="upcoming__race AUS"  style="">
          <img class="upcoming__img" src="https://d2zzz5z45zl95g.cloudfront.net/usr_imgs/flags/aus.png" alt="aus-img">
          <p class="upcoming__racetrack">Ascot R1</p>
          <div class="id_mnu_crr_178" >573 Min</div>
          <p>Pure blood</p>
        </div>
    
        <div id="id_hip2_219" class="upcoming__race AUS"  style="">
          <img class="upcoming__img" src="https://d2zzz5z45zl95g.cloudfront.net/usr_imgs/flags/aus.png" alt="aus-img">
          <p class="upcoming__racetrack">Tamworth R1</p>
          <div class="id_mnu_crr_219" >575 Min</div>
          <p>Pure blood</p>
        </div>
    
        <div id="id_hip2_174" class="upcoming__race AUS"  style="">
          <img class="upcoming__img" src="https://d2zzz5z45zl95g.cloudfront.net/usr_imgs/flags/aus.png" alt="aus-img">
          <p class="upcoming__racetrack">Gold Coast R1</p>
          <div class="id_mnu_crr_174" >593 Min</div>
          <p>Pure blood</p>
        </div>
    
        <div id="id_hip2_562" class="upcoming__race AUS" style="">
          <img class="upcoming__img" src="https://d2zzz5z45zl95g.cloudfront.net/usr_imgs/flags/aus.png" alt="aus-img">
          <p class="upcoming__racetrack">Darwin R1</p>
          <div class="id_mnu_crr_562" >684 Min</div>
          <p>Pure blood</p>
        </div>
    
        <div id="id_hip2_542" class="upcoming__race AUS"  style="">
          <img class="upcoming__img" src="https://d2zzz5z45zl95g.cloudfront.net/usr_imgs/flags/aus.png" alt="aus-img">
          <p class="upcoming__racetrack">Esperance R1</p>
          <div class="id_mnu_crr_542" >696 Min</div>
          <p>Pure blood</p>
        </div>
    
        <div id="id_hip2_741" class="upcoming__race FRA"  style="">
          <img class="upcoming__img" src="https://d2zzz5z45zl95g.cloudfront.net/usr_imgs/flags/fra.png" alt="fra-img">
          <p class="upcoming__racetrack">Deauville R1</p>
          <div class="id_mnu_crr_741" >1152 Min</div>
          <p>Pure blood</p>
        </div>
    
        <div id="id_hip2_915" class="upcoming__race JAM"  style="">
          <img class="upcoming__img" src="https://d2zzz5z45zl95g.cloudfront.net/usr_imgs/flags/jam.png" alt="jam-img">
          <p class="upcoming__racetrack">Caymanas Park R1</p>
          <div class="id_mnu_crr_915" >1394 Min</div>
          <p>Pure blood</p>
        </div>
    
        <div id="id_hip2_923" class="upcoming__race ECU"  style="">
          <img class="upcoming__img" src="https://d2zzz5z45zl95g.cloudfront.net/usr_imgs/flags/ecu.png" alt="ecu-img">
          <p class="upcoming__racetrack">Miguel Salem Dibo R1</p>
          <div class="id_mnu_crr_923" >2924 Min</div>
          <p>Pure blood</p>
        </div>
    </div>

        <div class="race" >

          <div class="race__data">
            <img src="https://www.universalhorse.club/img/iconos/caballo2.png" alt="horse-img">
            <div class="nombre_hipodromo" >UK Catterick Bridge</div>
            <div class="fecha_crr" >31/01/2025</div>
          </div>

          <div class="race__nraces" >
                <div ><span class="t_races">Races</span> :</div>
                <div class="race__nraces--active" id="all_btn_races" >
                  <div class="race__nraces--active" id="race_results" ></div>
                  {#each ($caballosList.lista ?? [])
                    .filter(c => c.np >= ($caballosList.icr ?? 0)) 
                    as caballos, i}
                      <div class="race__nraces--active" id="carreras_activas" ><button class="btn nrace {i=== 0 ? 'active': ''}" on:click="{() => seleccionarCarreraPorNP(caballos.np)}">{caballos.np}</button></div>
                  {/each} 
                </div>
              </div>

          <div class="race__time-programs" >
            <div class="race__time">
                  <div ><span class="t_s-time">Start time</span> :</div>
                  <div class="hora_inicio" >11:03:00</div>
                  <div > / </div>
                  <div ><span class="t_start-in">Starting in</span> :</div>
                  <div class="race__start-in" >0-1:58:27</div>
            </div>
            <div class="race__programs" >            
              <div ><span class="t_programs">Programs</span> :</div>
              <div class="race__programs" id="gacetas" >No available</div>
            </div>
          </div>
           
          <div class="race__type-bet" id="nav-tab" role="tablist" >
            <button class="btn type-bet active" id="pills-wps-tab" data-bs-toggle="tab" data-bs-target="#pills-wps" style="display: block;">W/P/S</button>
            <button class="btn type-bet" id="pills-exacta-tab" data-bs-toggle="tab" data-bs-target="#pills-exacta" style="display: block;">Exacta</button>
            <button class="btn type-bet" id="pills-trifecta-tab" data-bs-toggle="tab" data-bs-target="#pills-trifecta" style="display: block;">Trifecta</button>
            <button class="btn type-bet" id="pills-superfecta-tab" data-bs-toggle="tab" data-bs-target="#pills-superfecta" style="display: block;">Superfecta</button>
            <button class="btn type-bet" id="pills-cuotafija-tab" data-bs-toggle="tab" data-bs-target="#pills-winifjo" style="display: none;">Cuota Fija</button>
            <button class="btn type-bet" id="pills-pick2-tab" data-bs-toggle="tab" data-bs-target="#pills-pick2" style="display: none;">Pick 2</button>
            <button class="btn type-bet" id="pills-pick3-tab" data-bs-toggle="tab" data-bs-target="#pills-pick3" style="display: none;">Pick 3</button>
          </div>

          <div class="tab-content" id="bet_types_container" >
            <div class="tab-pane fade show active wps_2" id="pills-wps" >
              <div class="race__wps titles" >
                <div class="t_win cls_w"  style="display: block;">Win</div>
                <div class="t_place cls_p" style="display: block;">Place</div>
                <div class="t_show cls_s" style="display: none;">Show</div>
                <div class="" >NP</div>
                <div class="" >Montador</div>
                <div class="" >Entrenador</div>
                <div class="" >Peso</div>
                <div class="" >Med.</div>
                <div class="" >M/L</div>
              </div>
              <div class="race__container-races" id="cab_wps" >
      {#if $caballosList.lista.length > 0}
      {#each $caballosList.lista as caballo, index}
      <div class="race__wps" >
        <input class="ipt t_ph-win cls_w" placeholder="Win" type="number" id="_w_10780859_" autocomplete="off" data-raider="10780859,w,1,CAB,Kazar Forez,WIN" style="display: block;">
        <input class="ipt t_ph-place cls_p" placeholder="Place" type="number" id="_p_10780859_" autocomplete="off" data-raider="10780859,p,1,CAB,Kazar Forez,PLACE" style="display: block;">
        <input class="ipt t_ph-show cls_s" placeholder="Show" type="number" id="_s_10780859_" autocomplete="off" data-raider="10780859,s,1,CAB,Kazar Forez,SHOW" style="display: none;">
        
  <div class="race__nrace" >
    <img class="r-{index + 1}" src="https://d2zzz5z45zl95g.cloudfront.net/usr_imgs/icons/shield.svg">
    <p class="race__num">{caballo.np}</p>
  </div>
  <div>{caballo.cnombre}</div>
  <div >-</div>
  <div >{caballo.peso}</div>
  <div >{caballo.ml}</div>
  <div >BL</div>
      </div>
      {/each}
      {/if}
    
    </div>
            </div>
            <div class="tab-pane fade" id="pills-exacta" bis_skin_checked="1">
              <div class="race__exacta titles" bis_skin_checked="1">
                <div class="race__time" bis_skin_checked="1">1er<input class="chk all-bets" id="chk_all_exacta_1" type="checkbox"></div>
                <div class="race__time" bis_skin_checked="1">2do<input class="chk all-bets" id="chk_all_exacta_2" type="checkbox"></div>
                <div class="" bis_skin_checked="1">NP</div>
                <div class="" bis_skin_checked="1">Montador</div>
                <div class="" bis_skin_checked="1">Entrenador</div>
                <div class="" bis_skin_checked="1">Peso</div>
                <div class="" bis_skin_checked="1">Med.</div>
                <div class="" bis_skin_checked="1">M/L</div>
              </div>
              <div class="race__container-races" id="cab_exacta" bis_skin_checked="1">
      {#if $caballosList.lista.length > 0}
      {#each $caballosList.lista as caballo, idx}
      <div class="race__exacta " bis_skin_checked="1"><input class="chk exacta_1" type="checkbox" checked={estaMarcado(caballo, idx + 1, 1, caballo.track)} on:click={() => seleccionarCaballo(caballo, idx + 1, 1, caballo.track)}> 
                                                      <input class="chk exacta_2" type="checkbox" checked={estaMarcado(caballo, idx + 1, 2, caballo.track)} on:click={() => seleccionarCaballo(caballo, idx + 1, 2, caballo.track)}>
        
  <div class="race__nrace" bis_skin_checked="1">
    <img class="r-1" src="https://d2zzz5z45zl95g.cloudfront.net/usr_imgs/icons/shield.svg">
    <p class="race__num">{caballo.np}</p>
  </div>
  <div bis_skin_checked="1">{caballo.cnombre}</div>
  <div bis_skin_checked="1">-</div>
  <div bis_skin_checked="1">{caballo.peso}</div>
  <div bis_skin_checked="1">{caballo.ml}</div>
  <div bis_skin_checked="1">BL</div>
      </div>
      {/each}
  {/if}
  </div>
            </div>
            <div class="tab-pane fade" id="pills-trifecta" bis_skin_checked="1">
              <div class="race__trifecta titles" bis_skin_checked="1">
                <div class="race__time" bis_skin_checked="1">1er<input class="chk all-bets" id="chk_all_trifecta_1" type="checkbox"></div>
                <div class="race__time" bis_skin_checked="1">2do<input class="chk all-bets" id="chk_all_trifecta_2" type="checkbox"></div>
                <div class="race__time" bis_skin_checked="1">3ro<input class="chk all-bets" id="chk_all_trifecta_3" type="checkbox"></div>
                <div class="" bis_skin_checked="1">NP</div>
                <div class="" bis_skin_checked="1">Montador</div>
                <div class="" bis_skin_checked="1">Entrenador</div>
                <div class="" bis_skin_checked="1">Peso</div>
                <div class="" bis_skin_checked="1">Med.</div>
                <div class="" bis_skin_checked="1">M/L</div>
              </div>
              <div class="race__container-races" id="cab_trifecta" bis_skin_checked="1">
      {#if $caballosList.lista.length > 0}
      {#each $caballosList.lista as caballo}
      <div class="race__trifecta " bis_skin_checked="1"><input class="chk trifecta_1" type="checkbox" ><input class="chk trifecta_2" type="checkbox" ><input class="chk trifecta_3" type="checkbox" >
        
  <div class="race__nrace" bis_skin_checked="1">
    <img class="r-1" src="https://d2zzz5z45zl95g.cloudfront.net/usr_imgs/icons/shield.svg">
    <p class="race__num">{caballo.np}</p>
  </div>
  <div bis_skin_checked="1">{caballo.cnombre}</div>
  <div bis_skin_checked="1">-</div>
  <div bis_skin_checked="1">{caballo.peso}</div>
  <div bis_skin_checked="1">{caballo.ml}</div>
  <div bis_skin_checked="1">BL</div>
      </div>
      {/each}
      {/if}
</div>
            </div>
            <div class="tab-pane fade" id="pills-superfecta" bis_skin_checked="1">
              <div class="race__superfecta titles" bis_skin_checked="1">
                <div class="race__time" bis_skin_checked="1">1er<input class="chk all-bets" id="chk_all_superfecta_1"  type="checkbox"></div>
                <div class="race__time" bis_skin_checked="1">2do<input class="chk all-bets" id="chk_all_superfecta_2"  type="checkbox"></div>
                <div class="race__time" bis_skin_checked="1">3ro<input class="chk all-bets" id="chk_all_superfecta_3"  type="checkbox"></div>
                <div class="race__time" bis_skin_checked="1">4to<input class="chk all-bets" id="chk_all_superfecta_4"  type="checkbox"></div>
                <div class="" bis_skin_checked="1">NP</div>
                <div class="" bis_skin_checked="1">Montador</div>
                <div class="" bis_skin_checked="1">Entrenador</div>
                <div class="" bis_skin_checked="1">Peso</div>
                <div class="" bis_skin_checked="1">Med.</div>
                <div class="" bis_skin_checked="1">M/L</div>
              </div>
              <div class="race__container-races" id="cab_superfecta" bis_skin_checked="1">
      {#if $caballosList.lista.length > 0}
      {#each $caballosList.lista as caballo}
      <div class="race__superfecta " bis_skin_checked="1"><input class="chk superfecta_1" type="checkbox" ><input class="chk superfecta_2" type="checkbox" ><input class="chk superfecta_3" type="checkbox" ><input class="chk superfecta_4" type="checkbox" >
        
  <div class="race__nrace" bis_skin_checked="1">
    <img class="r-1" src="https://d2zzz5z45zl95g.cloudfront.net/usr_imgs/icons/shield.svg">
    <p class="race__num">{caballo.np}</p>
  </div>
  <div bis_skin_checked="1">{caballo.cnombre}</div>
  <div bis_skin_checked="1">-</div>
  <div bis_skin_checked="1">{caballo.peso}</div>
  <div bis_skin_checked="1">{caballo.ml}</div>
  <div bis_skin_checked="1">BL</div>
      </div>
      {/each}
      {/if}
</div>
            </div>
            <div class="tab-pane fade" id="pills-winifjo" bis_skin_checked="1">pills-winifjo</div>
            <div class="tab-pane fade" id="pills-pick2" bis_skin_checked="1">
              <div class="nav race__type-bet--pick" id="nav-tab-pick2" role="tablist" bis_skin_checked="1">
                <button class="btn type-bet active" id="pills-pick2-r1-tab" data-bs-toggle="tab" data-bs-target="#pills-pick2-r1">#<span class="t_race">Race</span> 1</button>
                <button class="btn type-bet" id="pills-pick2-r2-tab" data-bs-toggle="tab" data-bs-target="#pills-pick2-r2">#<span class="t_race">Race</span> 2</button>
              </div>
              <div class="tab-content" id="cab_pick2" bis_skin_checked="1">
                <div class="tab-pane fade show active" id="pills-pick2-r1" bis_skin_checked="1">
                  <div class="race__pick2 titles" bis_skin_checked="1">
                    <div class="race__time" bis_skin_checked="1">1ro<input class="chk all-bets" id="chk_all_pick2_1"  type="checkbox"></div>
                    <div class="" bis_skin_checked="1">NP</div>
                    <div class="" bis_skin_checked="1">Montador</div>
                    <div class="" bis_skin_checked="1">Entrenador</div>
                    <div class="" bis_skin_checked="1">Peso</div>
                    <div class="" bis_skin_checked="1">Med</div>
                    <div class="" bis_skin_checked="1">M/L</div>
                  </div>
                  <div class="race__container-races--pick" id="cab_pick2_1" bis_skin_checked="1">
      <div class="race__pick2 " bis_skin_checked="1"><input class="chk pick2_1" type="checkbox" >
        
  <div class="race__nrace" bis_skin_checked="1">
    <img class="r-1" src="https://d2zzz5z45zl95g.cloudfront.net/usr_imgs/icons/shield.svg">
    <p class="race__num">1</p>
  </div>
  <div bis_skin_checked="1">Kazar Forez</div>
  <div bis_skin_checked="1">-</div>
  <div bis_skin_checked="1">LB:168</div>
  <div bis_skin_checked="1">7/1</div>
  <div bis_skin_checked="1">BL</div>
      </div>
      <div class="race__pick2 " bis_skin_checked="1"><input class="chk pick2_1" type="checkbox" >
        
  <div class="race__nrace" bis_skin_checked="1">
    <img class="r-2" src="https://d2zzz5z45zl95g.cloudfront.net/usr_imgs/icons/shield.svg">
    <p class="race__num">2</p>
  </div>
  <div bis_skin_checked="1">Balcomie Breeze</div>
  <div bis_skin_checked="1">-</div>
  <div bis_skin_checked="1">LB:166</div>
  <div bis_skin_checked="1">6/1</div>
  <div bis_skin_checked="1">BL</div>
      </div>
      <div class="race__pick2 " bis_skin_checked="1"><input class="chk pick2_1" type="checkbox" >
        
  <div class="race__nrace" bis_skin_checked="1">
    <img class="r-3" src="https://d2zzz5z45zl95g.cloudfront.net/usr_imgs/icons/shield.svg">
    <p class="race__num">3</p>
  </div>
  <div bis_skin_checked="1">Lahire</div>
  <div bis_skin_checked="1">-</div>
  <div bis_skin_checked="1">LB:164</div>
  <div bis_skin_checked="1">1/1</div>
  <div bis_skin_checked="1">BL</div>
      </div>
      <div class="race__pick2 " bis_skin_checked="1"><input class="chk pick2_1" type="checkbox" >
        
  <div class="race__nrace" bis_skin_checked="1">
    <img class="r-4" src="https://d2zzz5z45zl95g.cloudfront.net/usr_imgs/icons/shield.svg">
    <p class="race__num">4</p>
  </div>
  <div bis_skin_checked="1">Little Pi</div>
  <div bis_skin_checked="1">-</div>
  <div bis_skin_checked="1">LB:162</div>
  <div bis_skin_checked="1">7/1</div>
  <div bis_skin_checked="1">BL</div>
      </div>
      <div class="race__pick2 " bis_skin_checked="1"><input class="chk pick2_1" type="checkbox" >
        
  <div class="race__nrace" bis_skin_checked="1">
    <img class="r-5" src="https://d2zzz5z45zl95g.cloudfront.net/usr_imgs/icons/shield.svg">
    <p class="race__num">5</p>
  </div>
  <div bis_skin_checked="1">Kellies Dream</div>
  <div bis_skin_checked="1">-</div>
  <div bis_skin_checked="1">LB:158</div>
  <div bis_skin_checked="1">8/1</div>
  <div bis_skin_checked="1">BL</div>
      </div>
      <div class="race__pick2 " bis_skin_checked="1"><input class="chk pick2_1" type="checkbox" >
        
  <div class="race__nrace" bis_skin_checked="1">
    <img class="r-6" src="https://d2zzz5z45zl95g.cloudfront.net/usr_imgs/icons/shield.svg">
    <p class="race__num">6</p>
  </div>
  <div bis_skin_checked="1">Kuma Beach</div>
  <div bis_skin_checked="1">-</div>
  <div bis_skin_checked="1">LB:149</div>
  <div bis_skin_checked="1">20/1</div>
  <div bis_skin_checked="1">BL</div>
      </div>
      <div class="race__pick2 " bis_skin_checked="1"><input class="chk pick2_1" type="checkbox" >
        
  <div class="race__nrace" bis_skin_checked="1">
    <img class="r-7" src="https://d2zzz5z45zl95g.cloudfront.net/usr_imgs/icons/shield.svg">
    <p class="race__num">7</p>
  </div>
  <div bis_skin_checked="1">Admiral Fitz</div>
  <div bis_skin_checked="1">-</div>
  <div bis_skin_checked="1">LB:144</div>
  <div bis_skin_checked="1">10/1</div>
  <div bis_skin_checked="1">BL</div>
      </div>
      <div class="race__pick2 " bis_skin_checked="1"><input class="chk pick2_1" type="checkbox" >
        
  <div class="race__nrace" bis_skin_checked="1">
    <img class="r-8" src="https://d2zzz5z45zl95g.cloudfront.net/usr_imgs/icons/shield.svg">
    <p class="race__num">8</p>
  </div>
  <div bis_skin_checked="1">Inoue</div>
  <div bis_skin_checked="1">-</div>
  <div bis_skin_checked="1">LB:142</div>
  <div bis_skin_checked="1">30/1</div>
  <div bis_skin_checked="1">BL</div>
      </div></div>
                </div>
                <div class="tab-pane fade" id="pills-pick2-r2" bis_skin_checked="1">
                  <div class="race__pick2 titles" bis_skin_checked="1">
                    <div class="race__time" bis_skin_checked="1">2do<input class="chk all-bets" id="chk_all_pick2_2"  type="checkbox"></div>
                    <div class="" bis_skin_checked="1">NP</div>
                    <div class="" bis_skin_checked="1">Montador</div>
                    <div class="" bis_skin_checked="1">Entrenador</div>
                    <div class="" bis_skin_checked="1">Peso</div>
                    <div class="" bis_skin_checked="1">Med</div>
                    <div class="" bis_skin_checked="1">M/L</div>
                  </div>
                  <div class="race__container-races--pick" id="cab_pick2_2" bis_skin_checked="1"></div>
                </div>
              </div>
            
            </div>
            <div class="tab-pane fade" id="pills-pick3" bis_skin_checked="1">
              <div class="nav race__type-bet--pick" id="nav-tab-pick2" role="tablist" bis_skin_checked="1">
                <button class="btn type-bet active" id="pills-pick3-r1-tab" data-bs-toggle="tab" data-bs-target="#pills-pick3-r1">#<span class="t_race">Race</span> 1</button>
                <button class="btn type-bet" id="pills-pick3-r2-tab" data-bs-toggle="tab" data-bs-target="#pills-pick3-r2">#<span class="t_race">Race</span> 2</button>
                <button class="btn type-bet" id="pills-pick3-r3-tab" data-bs-toggle="tab" data-bs-target="#pills-pick3-r3">#<span class="t_race">Race</span> 3</button>
              </div>
              <div class="tab-content" id="cab_pick3" bis_skin_checked="1">
                <div class="tab-pane fade show active" id="pills-pick3-r1" bis_skin_checked="1">
                  <div class="race__pick3 titles" bis_skin_checked="1">
                    <div class="race__time" bis_skin_checked="1">1ro<input class="chk all-bets" id="chk_all_pick3_1"  type="checkbox"></div>
                    <div class="" bis_skin_checked="1">NP</div>
                    <div class="" bis_skin_checked="1">Montador</div>
                    <div class="" bis_skin_checked="1">Entrenador</div>
                    <div class="" bis_skin_checked="1">Peso</div>
                    <div class="" bis_skin_checked="1">Med</div>
                    <div class="" bis_skin_checked="1">M/L</div>
                  </div>
                  <div class="race__container-races--pick" id="cab_pick3_1" bis_skin_checked="1">
      <div class="race__pick3 " bis_skin_checked="1"><input class="chk pick3_1" type="checkbox" >
        
  <div class="race__nrace" bis_skin_checked="1">
    <img class="r-1" src="https://d2zzz5z45zl95g.cloudfront.net/usr_imgs/icons/shield.svg">
    <p class="race__num">1</p>
  </div>
  <div bis_skin_checked="1">Kazar Forez</div>
  <div bis_skin_checked="1">-</div>
  <div bis_skin_checked="1">LB:168</div>
  <div bis_skin_checked="1">7/1</div>
  <div bis_skin_checked="1">BL</div>
      </div>
      <div class="race__pick3 " bis_skin_checked="1"><input class="chk pick3_1" type="checkbox" >
        
  <div class="race__nrace" bis_skin_checked="1">
    <img class="r-2" src="https://d2zzz5z45zl95g.cloudfront.net/usr_imgs/icons/shield.svg">
    <p class="race__num">2</p>
  </div>
  <div bis_skin_checked="1">Balcomie Breeze</div>
  <div bis_skin_checked="1">-</div>
  <div bis_skin_checked="1">LB:166</div>
  <div bis_skin_checked="1">6/1</div>
  <div bis_skin_checked="1">BL</div>
      </div>
      <div class="race__pick3 " bis_skin_checked="1"><input class="chk pick3_1" type="checkbox" >
        
  <div class="race__nrace" bis_skin_checked="1">
    <img class="r-3" src="https://d2zzz5z45zl95g.cloudfront.net/usr_imgs/icons/shield.svg">
    <p class="race__num">3</p>
  </div>
  <div bis_skin_checked="1">Lahire</div>
  <div bis_skin_checked="1">-</div>
  <div bis_skin_checked="1">LB:164</div>
  <div bis_skin_checked="1">1/1</div>
  <div bis_skin_checked="1">BL</div>
      </div>
      <div class="race__pick3 " bis_skin_checked="1"><input class="chk pick3_1" type="checkbox" >
        
  <div class="race__nrace" bis_skin_checked="1">
    <img class="r-4" src="https://d2zzz5z45zl95g.cloudfront.net/usr_imgs/icons/shield.svg">
    <p class="race__num">4</p>
  </div>
  <div bis_skin_checked="1">Little Pi</div>
  <div bis_skin_checked="1">-</div>
  <div bis_skin_checked="1">LB:162</div>
  <div bis_skin_checked="1">7/1</div>
  <div bis_skin_checked="1">BL</div>
      </div>
      <div class="race__pick3 " bis_skin_checked="1"><input class="chk pick3_1" type="checkbox" >
        
  <div class="race__nrace" bis_skin_checked="1">
    <img class="r-5" src="https://d2zzz5z45zl95g.cloudfront.net/usr_imgs/icons/shield.svg">
    <p class="race__num">5</p>
  </div>
  <div bis_skin_checked="1">Kellies Dream</div>
  <div bis_skin_checked="1">-</div>
  <div bis_skin_checked="1">LB:158</div>
  <div bis_skin_checked="1">8/1</div>
  <div bis_skin_checked="1">BL</div>
      </div>
      <div class="race__pick3 " bis_skin_checked="1"><input class="chk pick3_1" type="checkbox" >
        
  <div class="race__nrace" bis_skin_checked="1">
    <img class="r-6" src="https://d2zzz5z45zl95g.cloudfront.net/usr_imgs/icons/shield.svg">
    <p class="race__num">6</p>
  </div>
  <div bis_skin_checked="1">Kuma Beach</div>
  <div bis_skin_checked="1">-</div>
  <div bis_skin_checked="1">LB:149</div>
  <div bis_skin_checked="1">20/1</div>
  <div bis_skin_checked="1">BL</div>
      </div>
      <div class="race__pick3 " bis_skin_checked="1"><input class="chk pick3_1" type="checkbox" >
        
  <div class="race__nrace" bis_skin_checked="1">
    <img class="r-7" src="https://d2zzz5z45zl95g.cloudfront.net/usr_imgs/icons/shield.svg">
    <p class="race__num">7</p>
  </div>
  <div bis_skin_checked="1">Admiral Fitz</div>
  <div bis_skin_checked="1">-</div>
  <div bis_skin_checked="1">LB:144</div>
  <div bis_skin_checked="1">10/1</div>
  <div bis_skin_checked="1">BL</div>
      </div>
      <div class="race__pick3 " bis_skin_checked="1"><input class="chk pick3_1" type="checkbox" >
        
  <div class="race__nrace" bis_skin_checked="1">
    <img class="r-8" src="https://d2zzz5z45zl95g.cloudfront.net/usr_imgs/icons/shield.svg">
    <p class="race__num">8</p>
  </div>
  <div bis_skin_checked="1">Inoue</div>
  <div bis_skin_checked="1">-</div>
  <div bis_skin_checked="1">LB:142</div>
  <div bis_skin_checked="1">30/1</div>
  <div bis_skin_checked="1">BL</div>
      </div></div>
                </div>
                <div class="tab-pane fade" id="pills-pick3-r2" bis_skin_checked="1">
                  <div class="race__pick3 titles" bis_skin_checked="1">
                    <div class="race__time" bis_skin_checked="1">2do<input class="chk all-bets" id="chk_all_pick3_2" type="checkbox"></div>
                    <div class="" bis_skin_checked="1">NP</div>
                    <div class="" bis_skin_checked="1">Montador</div>
                    <div class="" bis_skin_checked="1">Entrenador</div>
                    <div class="" bis_skin_checked="1">Peso</div>
                    <div class="" bis_skin_checked="1">Med</div>
                    <div class="" bis_skin_checked="1">M/L</div>
                  </div>
                  <div class="race__container-races--pick" id="cab_pick3_2" bis_skin_checked="1"></div>
                </div>
                <div class="tab-pane fade" id="pills-pick3-r3" bis_skin_checked="1">
                  <div class="race__pick3 titles" bis_skin_checked="1">
                    <div class="race__time" bis_skin_checked="1">3ro<input class="chk all-bets" id="chk_all_pick3_3" type="checkbox"></div>
                    <div class="" bis_skin_checked="1">NP</div>
                    <div class="" bis_skin_checked="1">Montador</div>
                    <div class="" bis_skin_checked="1">Entrenador</div>
                    <div class="" bis_skin_checked="1">Peso</div>
                    <div class="" bis_skin_checked="1">Med</div>
                    <div class="" bis_skin_checked="1">M/L</div>
                  </div>
                  <div class="race__container-races--pick" id="cab_pick3_3" bis_skin_checked="1"></div>
                </div>
              </div>
            </div>
          </div>
          <div class="race_results_container" id="race_results_container" style="display:none" bis_skin_checked="1">
          <!--ESTO DEBERIA SER TODO UNA SOLA REPSUEST AASI SE REHAGAN LOS TITIULOS , AUNQUE ESTA POR VERSE-->
            <div class="race__result titles" bis_skin_checked="1">
              <div class="" bis_skin_checked="1">NP</div>
              <div class="" bis_skin_checked="1">Caballo</div>
              <div class="" bis_skin_checked="1">Montador</div>
              <div class="" bis_skin_checked="1">Peso</div>
              <div class="" bis_skin_checked="1">Entrenador</div>
              <div class="" bis_skin_checked="1">Win</div>
              <div class="" bis_skin_checked="1">Place</div>
              <div class="" bis_skin_checked="1">Show</div>
            </div>
            <div id="cab_results" bis_skin_checked="1"></div>
            <div class="race__result-exo titles" bis_skin_checked="1">
              <div class="" bis_skin_checked="1">Tipo de apuesta</div>
              <div class="" bis_skin_checked="1">Combinación</div>
              <div class="" bis_skin_checked="1">Denominación</div>
              <div class="" bis_skin_checked="1">Pago</div>
            </div>
            <div id="cab_results-exo" bis_skin_checked="1"></div>
            <div class="title__retired" bis_skin_checked="1">Retirados</div>
            <div class="race__result-retired titles" bis_skin_checked="1">
              <div class="" bis_skin_checked="1">NP</div>  
              <div class="" bis_skin_checked="1">Caballo</div>
              <div class="" bis_skin_checked="1">Entrenador</div>
              <div class="" bis_skin_checked="1">Peso</div>
              <div class="" bis_skin_checked="1">ML</div>
            </div>
            <div id="cab_results-retired" bis_skin_checked="1"></div>
          </div>

       
      </div>
      <!-- </div> -->
    </section>
    <section class='main__right'>
<section class="betslip">
      <div class="betslip__container--title" bis_skin_checked="1">
          <div bis_skin_checked="1"></div>
          <div class="betslip__title" bis_skin_checked="1">Talón de apuestas</div>
          <i class="fas fa-trash betslip__trash"></i>
        </div>

      <div class="betslip__bets" id="cabbetslip" bis_skin_checked="1">

    </div>  
    <div bis_skin_checked="1">Número de apuestas <span id="betjugada">0</span></div>
    <div bis_skin_checked="1">Total : <span id="bettotal">0</span></div>
    <button class="btn"  id="btn_venta">Realizar apuesta</button>
</section>
    </section>
  </div>
</div>
