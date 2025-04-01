<script lang="ts">
    import './page.css';
    import Header from './Header.svelte';
    import 'bootstrap/dist/css/bootstrap.min.css';
    import 'bootstrap/dist/js/bootstrap.bundle.min.js';
    import { getAmountOfRaceByType } from './function.js';
    import './main.scss';
    import { getHipodromosActivos } from '../lib/api/services/necoHipodromosActivos.service.js';
    import { getHipodromosPorTipo } from '../lib/api/services/necoHipodromosPorTipo.service.js';
    import { userSession } from '../lib/api/stores/userLogin.js';
	  import { onMount } from 'svelte';
	  import type { NecoHipodromosActivosResponse } from '../lib/api/models/NecoHipodromosActivosResponse.js';
    import type { HipodromosPorTipoResponse } from '../lib/api/models/NecoHipodromosPorTipoResponse.js';
  let totalRaces = $state(getAmountOfRaceByType());

    $effect(() =>{
        totalRaces = getAmountOfRaceByType();
    });

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
    
</script>

<div class="uhorses" >
    <div class='main'>
      <div class="" >
        <div class="btn race active"  >{totalRaces.type1}<span id="badge_caballo"></span><img src="https://www.universalhorse.club/img/iconos/caballos001.png" alt=""></div>
        <div class="btn race"  ><span id="badge_galgo">{totalRaces.type2}</span><img src="https://www.universalhorse.club/img/iconos/galgo01.png" alt=""></div>
        <div class="btn race"  ><span id="badge_carretas">{totalRaces.type3}</span><img src="https://www.universalhorse.club/img/iconos/carreta01.png" alt=""></div>
        <div class="btn race" ><img src="https://www.universalhorse.club/img/iconos/jackpolla01.png" alt=""></div>
        <div class="btn race" ><img src="https://www.universalhorse.club/img/iconos/reloj01.png" alt=""><div ></div></div>
        <div class="btn race" ><img src="https://www.universalhorse.club/img/iconos/caballos_retirado.png" alt=""><div >Retirados</div></div>
        <div class="btn race" ><img src="https://www.universalhorse.club/img/iconos/resultados.png" alt=""><div >Programas</div></div>
        <div class="btn race" ><img src="https://www.universalhorse.club/img/iconos/engranaje01.png" alt=""><div >Resultados</div></div>
        <div class="btn race" ><img src="https://www.universalhorse.club/img/iconos/engranaje01.png" alt=""></div>
      </div>
            <div class="" >
      </div>
      </div>

      
</div>
<div class="mostrar listado hipodromos activos">
  {#each hipodromos as tipoData}
  <h3>Tipo: {tipoData.tipo}</h3>
  {#each tipoData.paises as paisData}
    <h4>País: {paisData.pais} ({paisData.cantidad} carreras)</h4>
    <ul>
      {#each paisData.carreras as carrera}
        <li>{carrera.nombre_pista} - ID: {carrera.id_pista} - ⏳ {carrera.tiempo_restante} seg</li>
      {/each}
    </ul>
  {/each}
{/each}

</div>