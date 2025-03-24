<script lang="ts">
    import './page.css';
    import 'bootstrap/dist/css/bootstrap.min.css';
    import 'bootstrap/dist/js/bootstrap.bundle.min.js';
    // import { data } from './horses.js';  
    // import { getRacetracksByCountry, countryArray } from './function.js';
    import './main.scss';
    // getRacetracksByCountry(data);
    // import { verCaballos } from './ver_caballos/function_ver_caballos.js';  
  
    // let allCountries = $state<{ pais: string; cantidad: number; carreras?: any[] }[]>([]);
    // $effect(() => {
    //   allCountries = countryArray.flatMap((typeEntry: { tipo: number; paises: { pais: string; cantidad: number; carreras?: any[] }[] }) => typeEntry.paises);
    // });
  
    import { onDestroy } from 'svelte';
	  import { error } from '@sveltejs/kit';
    import { API_BASE_URL } from '../lib/api.js';

    let raceByType = {type1: 0, type2: 0, type3: 0};
    let ws: WebSocket | null = null;

    function connectWebScoket(){
      ws = new WebSocket('ws://localhost:8081');

      ws.onopen = () =>{
        console.log("ws conetado en mi svelte");
      }

      ws.onmessage = (event) =>{
        try{
          const message = JSON.parse(event.data);

          if(message.type === 'update'){
            raceByType = message.raceAmounts;
          }
        } catch(error){
          console.error('error al procesar el mensaje de  ws', error);
          
        }
      };

      ws.onerror = (error) =>{
        console.error("error en ws", error);
        
      };
      
      ws.onclose = ()=>{
        console.log("ws desconectado...");
        
      }
    }
    
    connectWebScoket();

    onDestroy(() => {
        if (ws) ws.close();
    });

    import { loginWithCredential } from '../lib/api/services/neco/neco.service.js';

    let usr = "";
    let pass = "";
    let message = "";
    let isError = false;

    async function login() {
      message = "";
      isError = false;

      try{
        const result = await loginWithCredential(usr, pass);
        message = "login existoso :)"

      } catch(err){
        isError = true;
        message = "Error al loguearse"
      }
      
    }
    
  </script>

  <div class="race-types">
    <p>Tipo 1: {raceByType.type1}</p>
    <p>Tipo 2: {raceByType.type2}</p>
    <p>Tipo 3: {raceByType.type3}</p>
  </div>

  <form on:submit|preventDefault={login}>
    <input class="usr" type="text" style="color: black;" bind:value={usr} placeholder="usuario" required >
    <input class="pass" type="password" style="color: black;" bind:value={pass} placeholder="contrania" required>
    <button type="submit">iniciar sesion</button>
  </form>

  {#if message}
    <p style="color: {isError ? 'red' : 'green'};">{message}</p>
  {/if}
  
  <!-- <div class="uhorses" > -->
    <!-- <div class='main'> -->
      
            <!-- <div class="" bis_skin_checked="1"> -->
               
              <!-- comienza el div de paises x carrera  -->
              <!-- <div class="racetrack" id="hip_pais" bis_skin_checked="1"> -->
                <!-- {#each allCountries as country, countryIndex} -->
        <!-- <button class="btn racetrack__bycountry" data-bs-toggle="collapse" data-bs-target={`#collapse${countryIndex}`} id="racetrack_CHL" style="" aria-controls={`collapse${countryIndex}`}> -->
          <!-- <img class="racetrack__img" src="https://d2zzz5z45zl95g.cloudfront.net/usr_imgs/flags/{country.pais.toLowerCase()}.png" alt="chl-img"> -->
          <!-- <p>{country.pais}</p> -->
          <!-- <span class="racetrack__number" id="cont_CHL">{country.cantidad}</span> -->
        <!-- </button> -->
        <!-- <div class="collapse" id={`collapse${countryIndex}`} bis_skin_checked="1"> -->
          <!-- <div class="racetrack__event title" bis_skin_checked="1"> -->
            <!-- <div class="t_time" bis_skin_checked="1">Time</div> -->
            <!-- <div class="t_racetrack" bis_skin_checked="1">Racetrack</div> -->
            <!-- <div bis_skin_checked="1">#</div>  -->
          <!-- </div> -->
          <!-- <div id="hip_collapse_CHL" bis_skin_checked="1"> -->
          
            <!-- comienza div de carreras  -->
            <!-- {#each (country.carreras ??[] ) as carrera, raceIndex(carrera.id || raceIndex)} -->
      <!-- <div on:click={()=>verCaballos(carrera.id_pista, carrera.name_pista, carrera.id_track, carrera.crr, carrera.id_crr)} id="id_hip_{countryIndex}_{raceIndex}" class="racetrack__event racetr"  bis_skin_checked="1"> -->
        <!-- <div class="id_mnu_crr_551" bis_skin_checked="1">{carrera.time} Seg</div>  -->
        <!-- <div class="name" bis_skin_checked="1">{carrera.name_pista}</div> -->
        <!-- <div bis_skin_checked="1">{carrera.crr}</div>  -->
      <!-- </div> -->
      <!-- {/each} -->
      <!-- termina div de carreras  -->
    <!-- </div> -->
        <!-- </div> -->
       <!-- {/each} -->
        <!-- </div> -->
        <!-- termina el div de pais y carrera x pais  -->
      <!-- </div> -->
      <!-- </div> -->
<!-- </div> -->