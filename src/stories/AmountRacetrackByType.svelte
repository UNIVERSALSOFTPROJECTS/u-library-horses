<script lang="ts">
    import './page.css';
    import Header from './Header.svelte';
    import 'bootstrap/dist/css/bootstrap.min.css';
    import 'bootstrap/dist/js/bootstrap.bundle.min.js';
    import { getAmountOfRaceByType } from './function.js';
    import './main.scss';
    let totalRaces = $state(getAmountOfRaceByType());

    $effect(() =>{
        totalRaces = getAmountOfRaceByType();
    });
</script>

<div class="uhorses" >
    <div class='main'>
      <div class="" bis_skin_checked="1">
        <div class="btn race active"  bis_skin_checked="1">{totalRaces.type1}<span id="badge_caballo"></span><img src="https://www.universalhorse.club/img/iconos/caballos001.png" alt=""></div>
        <div class="btn race"  bis_skin_checked="1"><span id="badge_galgo">{totalRaces.type2}</span><img src="https://www.universalhorse.club/img/iconos/galgo01.png" alt=""></div>
        <div class="btn race"  bis_skin_checked="1"><span id="badge_carretas">{totalRaces.type3}</span><img src="https://www.universalhorse.club/img/iconos/carreta01.png" alt=""></div>
        <div class="btn race" bis_skin_checked="1"><img src="https://www.universalhorse.club/img/iconos/jackpolla01.png" alt=""></div>
        <div class="btn race" bis_skin_checked="1"><img src="https://www.universalhorse.club/img/iconos/reloj01.png" alt=""><div bis_skin_checked="1"></div></div>
        <div class="btn race" bis_skin_checked="1"><img src="https://www.universalhorse.club/img/iconos/caballos_retirado.png" alt=""><div bis_skin_checked="1">Retirados</div></div>
        <div class="btn race" bis_skin_checked="1"><img src="https://www.universalhorse.club/img/iconos/resultados.png" alt=""><div bis_skin_checked="1">Programas</div></div>
        <div class="btn race" bis_skin_checked="1"><img src="https://www.universalhorse.club/img/iconos/engranaje01.png" alt=""><div bis_skin_checked="1">Resultados</div></div>
        <div class="btn race" bis_skin_checked="1"><img src="https://www.universalhorse.club/img/iconos/engranaje01.png" alt=""></div>
      </div>
            <div class="" bis_skin_checked="1">
      </div>
      </div>
</div>