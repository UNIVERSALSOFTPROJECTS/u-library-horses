<script lang="ts">
  import './page.css';
  import Header from './Header.svelte';
  import 'bootstrap/dist/css/bootstrap.min.css';
  import 'bootstrap/dist/js/bootstrap.bundle.min.js';
  import { data } from './horses.js';  
  import { getRacetracksByCountry, countryArray } from './function.js';
  import './main.scss';
  let user = $state<{ name: string }>();
  getRacetracksByCountry(data);


  let allCountries = $state<{ pais: string; cantidad: number; carreras?: any[] }[]>([]);
  $effect(() => {
    allCountries = countryArray.flatMap((typeEntry: { tipo: number; paises: { pais: string; cantidad: number; carreras?: any[] }[] }) => typeEntry.paises);
  });
  
</script>

<div class="uhorses" >
  <Header></Header>
  <div class='main'>
    <section>
    <section class='main__left'>
      <!-- <div class="main__left" bis_skin_checked="1"> -->
          <div class="" bis_skin_checked="1">
            <div class="btn race active"  bis_skin_checked="1"><span id="badge_caballo">22</span><img src="https://www.universalhorse.club/img/iconos/caballos001.png" alt=""></div>
            <div class="btn race"  bis_skin_checked="1"><span id="badge_galgo">-</span><img src="https://www.universalhorse.club/img/iconos/galgo01.png" alt=""></div>
            <div class="btn race"  bis_skin_checked="1"><span id="badge_carretas">16</span><img src="https://www.universalhorse.club/img/iconos/carreta01.png" alt=""></div>
            <div class="btn race" bis_skin_checked="1"><img src="https://www.universalhorse.club/img/iconos/jackpolla01.png" alt=""></div>
            <div class="btn race" bis_skin_checked="1"><img src="https://www.universalhorse.club/img/iconos/reloj01.png" alt=""><div bis_skin_checked="1"></div></div>
            <div class="btn race" bis_skin_checked="1"><img src="https://www.universalhorse.club/img/iconos/caballos_retirado.png" alt=""><div bis_skin_checked="1">Retirados</div></div>
            <div class="btn race" bis_skin_checked="1"><img src="https://www.universalhorse.club/img/iconos/resultados.png" alt=""><div bis_skin_checked="1">Programas</div></div>
            <div class="btn race" bis_skin_checked="1"><img src="https://www.universalhorse.club/img/iconos/engranaje01.png" alt=""><div bis_skin_checked="1">Resultados</div></div>
            <div class="btn race" bis_skin_checked="1"><img src="https://www.universalhorse.club/img/iconos/engranaje01.png" alt=""></div>
          </div>
          <div class="" bis_skin_checked="1">

            <input type="search" class="ipt search t_srch-race" id="race_search" placeholder="Race search" autocomplete="off">
     
            <div class="dropdown" bis_skin_checked="1">
              <button class="btn filter t_fl-countries" type="button" data-bs-toggle="dropdown" data-bs-auto-close="outside">Filter countries</button>
              <div class="dropdown-menu" bis_skin_checked="1">
                <div class="filter__countries" id="filter_countries" bis_skin_checked="1">
      <div bis_skin_checked="1">
        <input type="checkbox" id="filter_country_CHL">
        <label for="filter_country_CHL">Chile</label>
      </div>
      <div bis_skin_checked="1">
        <input type="checkbox" id="filter_country_PAN">
        <label for="filter_country_PAN">Panamá</label>
      </div>
      <div bis_skin_checked="1">
        <input type="checkbox" id="filter_country_USA">
        <label for="filter_country_USA">Estados Unidos</label>
      </div>
      <div bis_skin_checked="1">
        <input type="checkbox" id="filter_country_ARG">
        <label for="filter_country_ARG">Argentina</label>
      </div>
      <div bis_skin_checked="1">
        <input type="checkbox" id="filter_country_NZ" >
        <label for="filter_country_NZ">Nueva Zelanda</label>
      </div>
      <div bis_skin_checked="1">
        <input type="checkbox" id="filter_country_AUS">
        <label for="filter_country_AUS">Australia</label>
      </div>
      <div bis_skin_checked="1">
        <input type="checkbox" id="filter_country_HK" >
        <label for="filter_country_HK">Hong Kong</label>
      </div>
      <div bis_skin_checked="1">
        <input type="checkbox" id="filter_country_JPN" >
        <label for="filter_country_JPN">Japon</label>
      </div>
      <div bis_skin_checked="1">
        <input type="checkbox" id="filter_country_FRA" >
        <label for="filter_country_FRA">Francia</label>
      </div>
      <div bis_skin_checked="1">
        <input type="checkbox" id="filter_country_JAM" >
        <label for="filter_country_JAM">Jamaica</label>
      </div>
      <div bis_skin_checked="1">
        <input type="checkbox" id="filter_country_ECU" >
        <label for="filter_country_ECU">Ecuador</label>
      </div></div>
              </div>
            </div>
             
            <div class="racetrack" id="hip_pais" bis_skin_checked="1">
      <button class="btn racetrack__bycountry" data-bs-toggle="collapse" data-bs-target="#collapse-CHL" id="racetrack_CHL" style="">
        <img class="racetrack__img" src="https://d2zzz5z45zl95g.cloudfront.net/usr_imgs/flags/chl.png" alt="chl-img">
        <p>Chile</p>
        <span class="racetrack__number" id="cont_CHL">1</span>
      </button>
      <div class="collapse" id="collapse-CHL" bis_skin_checked="1">
        <div class="racetrack__event title" bis_skin_checked="1">
          <div class="t_time" bis_skin_checked="1">Time</div>
          <div class="t_racetrack" bis_skin_checked="1">Racetrack</div>
          <div bis_skin_checked="1">#</div> 
        </div>
        <div id="hip_collapse_CHL" bis_skin_checked="1">
        
    <div id="id_hip_551" class="racetrack__event racetr"  bis_skin_checked="1">
      <div class="id_mnu_crr_551" bis_skin_checked="1">40 Seg</div> 
      <div class="name" bis_skin_checked="1">Hipodromo Chile</div>
      <div bis_skin_checked="1">R16</div>    
    </div></div>
      </div>
      <button class="btn racetrack__bycountry" data-bs-toggle="collapse" data-bs-target="#collapse-PAN" id="racetrack_PAN">
        <img class="racetrack__img" src="https://d2zzz5z45zl95g.cloudfront.net/usr_imgs/flags/pan.png" alt="pan-img">
        <p>Panamá</p>
        <span class="racetrack__number" id="cont_PAN">1</span>
      </button>
      <div class="collapse" id="collapse-PAN" bis_skin_checked="1">
        <div class="racetrack__event title" bis_skin_checked="1">
          <div class="t_time" bis_skin_checked="1">Time</div>
          <div class="t_racetrack" bis_skin_checked="1">Racetrack</div>
          <div bis_skin_checked="1">#</div> 
        </div>
        <div id="hip_collapse_PAN" bis_skin_checked="1">
        
    <div id="id_hip_977" class="racetrack__event racetr"  bis_skin_checked="1">
      <div class="id_mnu_crr_977" bis_skin_checked="1">40 Seg</div> 
      <div class="name" bis_skin_checked="1">Hipódromo Presidente Remón</div>
      <div bis_skin_checked="1">R2</div>    
    </div></div>
      </div>
      <button class="btn racetrack__bycountry" data-bs-toggle="collapse" data-bs-target="#collapse-USA" id="racetrack_USA" style="">
        <img class="racetrack__img" src="https://d2zzz5z45zl95g.cloudfront.net/usr_imgs/flags/usa.png" alt="usa-img">
        <p>Estados Unidos</p>
        <span class="racetrack__number" id="cont_USA">6</span>
      </button>
      <div class="collapse" id="collapse-USA" bis_skin_checked="1">
        <div class="racetrack__event title" bis_skin_checked="1">
          <div class="t_time" bis_skin_checked="1">Time</div>
          <div class="t_racetrack" bis_skin_checked="1">Racetrack</div>
          <div bis_skin_checked="1">#</div> 
        </div>
        <div id="hip_collapse_USA" bis_skin_checked="1">
        
    <div id="id_hip_25" class="racetrack__event racetr"  bis_skin_checked="1">
      <div class="id_mnu_crr_25" bis_skin_checked="1">1 Min</div> 
      <div class="name" bis_skin_checked="1">Fair Grounds</div>
      <div bis_skin_checked="1">R8</div>    
    </div>
    <div id="id_hip_20" class="racetrack__event racetr"  bis_skin_checked="1">
      <div class="id_mnu_crr_20" bis_skin_checked="1">17 Min</div> 
      <div class="name" bis_skin_checked="1">Turf Paradise</div>
      <div bis_skin_checked="1">R7</div>    
    </div>
    <div id="id_hip_34" class="racetrack__event racetr" bis_skin_checked="1">
      <div class="id_mnu_crr_34" bis_skin_checked="1">18 Min</div> 
      <div class="name" bis_skin_checked="1">Sunland Park</div>
      <div bis_skin_checked="1">R8</div>    
    </div>
    <div id="id_hip_21" class="racetrack__event racetr" bis_skin_checked="1">
      <div class="id_mnu_crr_21" bis_skin_checked="1">36 Min</div> 
      <div class="name" bis_skin_checked="1">Delta Downs</div>
      <div bis_skin_checked="1">R1</div>    
    </div>
    <div id="id_hip_27" class="racetrack__event racetr" bis_skin_checked="1">
      <div class="id_mnu_crr_27" bis_skin_checked="1">41 Min</div> 
      <div class="name" bis_skin_checked="1">Turfway Park</div>
      <div bis_skin_checked="1">R1</div>    
    </div>
    <div id="id_hip_4" class="racetrack__event racetr"  bis_skin_checked="1">
      <div class="id_mnu_crr_4" bis_skin_checked="1">106 Min</div> 
      <div class="name" bis_skin_checked="1">Charles Town</div>
      <div bis_skin_checked="1">R1</div>    
    </div></div>
      </div>
      <button class="btn racetrack__bycountry" data-bs-toggle="collapse" data-bs-target="#collapse-ARG" id="racetrack_ARG" style="">
        <img class="racetrack__img" src="https://d2zzz5z45zl95g.cloudfront.net/usr_imgs/flags/arg.png" alt="arg-img">
        <p>Argentina</p>
        <span class="racetrack__number" id="cont_ARG">1</span>
      </button>
      <div class="collapse" id="collapse-ARG" bis_skin_checked="1">
        <div class="racetrack__event title" bis_skin_checked="1">
          <div class="t_time" bis_skin_checked="1">Time</div>
          <div class="t_racetrack" bis_skin_checked="1">Racetrack</div>
          <div bis_skin_checked="1">#</div> 
        </div>
        <div id="hip_collapse_ARG" bis_skin_checked="1">
        
    <div id="id_hip_555" class="racetrack__event racetr"  bis_skin_checked="1">
      <div class="id_mnu_crr_555" bis_skin_checked="1">4 Min</div> 
      <div class="name" bis_skin_checked="1">Hipodromo de La Plata</div>
      <div bis_skin_checked="1">R11</div>    
    </div></div>
      </div>
      <button class="btn racetrack__bycountry" data-bs-toggle="collapse" data-bs-target="#collapse-NZ" id="racetrack_NZ" style="">
        <img class="racetrack__img" src="https://d2zzz5z45zl95g.cloudfront.net/usr_imgs/flags/nz.png" alt="nz-img">
        <p>Nueva Zelanda</p>
        <span class="racetrack__number" id="cont_NZ">1</span>
      </button>
      <div class="collapse" id="collapse-NZ" bis_skin_checked="1">
        <div class="racetrack__event title" bis_skin_checked="1">
          <div class="t_time" bis_skin_checked="1">Time</div>
          <div class="t_racetrack" bis_skin_checked="1">Racetrack</div>
          <div bis_skin_checked="1">#</div> 
        </div>
        <div id="hip_collapse_NZ" bis_skin_checked="1">
        
    <div id="id_hip_403" class="racetrack__event racetr"  bis_skin_checked="1">
      <div class="id_mnu_crr_403" bis_skin_checked="1">42 Min</div> 
      <div class="name" bis_skin_checked="1">New Zealand Te Rapa</div>
      <div bis_skin_checked="1">R1</div>    
    </div></div>
      </div>
      <button class="btn racetrack__bycountry" data-bs-toggle="collapse" data-bs-target="#collapse-AUS" id="racetrack_AUS" style="">
        <img class="racetrack__img" src="https://d2zzz5z45zl95g.cloudfront.net/usr_imgs/flags/aus.png" alt="aus-img">
        <p>Australia</p>
        <span class="racetrack__number" id="cont_AUS">7</span>
      </button>
      <div class="collapse" id="collapse-AUS" bis_skin_checked="1">
        <div class="racetrack__event title" bis_skin_checked="1">
          <div class="t_time" bis_skin_checked="1">Time</div>
          <div class="t_racetrack" bis_skin_checked="1">Racetrack</div>
          <div bis_skin_checked="1">#</div> 
        </div>
        <div id="hip_collapse_AUS" bis_skin_checked="1">
        
    <div id="id_hip_196" class="racetrack__event racetr"  bis_skin_checked="1">
      <div class="id_mnu_crr_196" bis_skin_checked="1">246 Min</div> 
      <div class="name" bis_skin_checked="1">Taree</div>
      <div bis_skin_checked="1">R1</div>    
    </div>
    <div id="id_hip_249" class="racetrack__event racetr"  bis_skin_checked="1">
      <div class="id_mnu_crr_249" bis_skin_checked="1">261 Min</div> 
      <div class="name" bis_skin_checked="1">Bathurst</div>
      <div bis_skin_checked="1">R1</div>    
    </div>
    <div id="id_hip_744" class="racetrack__event racetr"  bis_skin_checked="1">
      <div class="id_mnu_crr_744" bis_skin_checked="1">286 Min</div> 
      <div class="name" bis_skin_checked="1">Werribee</div>
      <div bis_skin_checked="1">R1</div>    
    </div>
    <div id="id_hip_541" class="racetrack__event racetr"  bis_skin_checked="1">
      <div class="id_mnu_crr_541" bis_skin_checked="1">441 Min</div> 
      <div class="name" bis_skin_checked="1">Albany</div>
      <div bis_skin_checked="1">R1</div>    
    </div>
    <div id="id_hip_246" class="racetrack__event racetr"  bis_skin_checked="1">
      <div class="id_mnu_crr_246" bis_skin_checked="1">526 Min</div> 
      <div class="name" bis_skin_checked="1">Canterbury</div>
      <div bis_skin_checked="1">R1</div>    
    </div>
    <div id="id_hip_296" class="racetrack__event racetr"  bis_skin_checked="1">
      <div class="id_mnu_crr_296" bis_skin_checked="1">541 Min</div> 
      <div class="name" bis_skin_checked="1">Moonee Valley</div>
      <div bis_skin_checked="1">R1</div>    
    </div>
    <div id="id_hip_228" class="racetrack__event racetr"  bis_skin_checked="1">
      <div class="id_mnu_crr_228" bis_skin_checked="1">594 Min</div> 
      <div class="name" bis_skin_checked="1">Sunshine Coast</div>
      <div bis_skin_checked="1">R1</div>    
    </div></div>
      </div>
      <button class="btn racetrack__bycountry" data-bs-toggle="collapse" data-bs-target="#collapse-HK" id="racetrack_HK" style="">
        <img class="racetrack__img" src="https://d2zzz5z45zl95g.cloudfront.net/usr_imgs/flags/hk.png" alt="hk-img">
        <p>Hong Kong</p>
        <span class="racetrack__number" id="cont_HK">1</span>
      </button>
      <div class="collapse" id="collapse-HK" bis_skin_checked="1">
        <div class="racetrack__event title" bis_skin_checked="1">
          <div class="t_time" bis_skin_checked="1">Time</div>
          <div class="t_racetrack" bis_skin_checked="1">Racetrack</div>
          <div bis_skin_checked="1">#</div> 
        </div>
        <div id="hip_collapse_HK" bis_skin_checked="1">
        
    <div id="id_hip_142" class="racetrack__event racetr"  bis_skin_checked="1">
      <div class="id_mnu_crr_142" bis_skin_checked="1">374 Min</div> 
      <div class="name" bis_skin_checked="1">Sha Tin, Hong Kong</div>
      <div bis_skin_checked="1">R1</div>    
    </div></div>
      </div>
      <button class="btn racetrack__bycountry" data-bs-toggle="collapse" data-bs-target="#collapse-JPN" id="racetrack_JPN">
        <img class="racetrack__img" src="https://d2zzz5z45zl95g.cloudfront.net/usr_imgs/flags/jpn.png" alt="jpn-img">
        <p>Japon</p>
        <span class="racetrack__number" id="cont_JPN">1</span>
      </button>
      <div class="collapse" id="collapse-JPN" bis_skin_checked="1">
        <div class="racetrack__event title" bis_skin_checked="1">
          <div class="t_time" bis_skin_checked="1">Time</div>
          <div class="t_racetrack" bis_skin_checked="1">Racetrack</div>
          <div bis_skin_checked="1">#</div> 
        </div>
        <div id="hip_collapse_JPN" bis_skin_checked="1">
        
    <div id="id_hip_567" class="racetrack__event racetr"  bis_skin_checked="1">
      <div class="id_mnu_crr_567" bis_skin_checked="1">446 Min</div> 
      <div class="name" bis_skin_checked="1">JPN Nagoya</div>
      <div bis_skin_checked="1">R1</div>    
    </div></div>
      </div>
      <button class="btn racetrack__bycountry" data-bs-toggle="collapse" data-bs-target="#collapse-FRA" id="racetrack_FRA" style="">
        <img class="racetrack__img" src="https://d2zzz5z45zl95g.cloudfront.net/usr_imgs/flags/fra.png" alt="fra-img">
        <p>Francia</p>
        <span class="racetrack__number" id="cont_FRA">1</span>
      </button>
      <div class="collapse" id="collapse-FRA" bis_skin_checked="1">
        <div class="racetrack__event title" bis_skin_checked="1">
          <div class="t_time" bis_skin_checked="1">Time</div>
          <div class="t_racetrack" bis_skin_checked="1">Racetrack</div>
          <div bis_skin_checked="1">#</div> 
        </div>
        <div id="hip_collapse_FRA" bis_skin_checked="1">
        
    <div id="id_hip_758" class="racetrack__event racetr"  bis_skin_checked="1">
      <div class="id_mnu_crr_758" bis_skin_checked="1">754 Min</div> 
      <div class="name" bis_skin_checked="1">Pau</div>
      <div bis_skin_checked="1">R1</div>    
    </div></div>
      </div>
      <button class="btn racetrack__bycountry" data-bs-toggle="collapse" data-bs-target="#collapse-JAM" id="racetrack_JAM" style="">
        <img class="racetrack__img" src="https://d2zzz5z45zl95g.cloudfront.net/usr_imgs/flags/jam.png" alt="jam-img">
        <p>Jamaica</p>
        <span class="racetrack__number" id="cont_JAM">1</span>
      </button>
      <div class="collapse" id="collapse-JAM" bis_skin_checked="1">
        <div class="racetrack__event title" bis_skin_checked="1">
          <div class="t_time" bis_skin_checked="1">Time</div>
          <div class="t_racetrack" bis_skin_checked="1">Racetrack</div>
          <div bis_skin_checked="1">#</div> 
        </div>
        <div id="hip_collapse_JAM" bis_skin_checked="1">
        
    <div id="id_hip_915" class="racetrack__event racetr"  bis_skin_checked="1">
      <div class="id_mnu_crr_915" bis_skin_checked="1">2566 Min</div> 
      <div class="name" bis_skin_checked="1">Caymanas Park</div>
      <div bis_skin_checked="1">R1</div>    
    </div></div>
      </div>
      <button class="btn racetrack__bycountry" data-bs-toggle="collapse" data-bs-target="#collapse-ECU" id="racetrack_ECU" style="">
        <img class="racetrack__img" src="https://d2zzz5z45zl95g.cloudfront.net/usr_imgs/flags/ecu.png" alt="ecu-img">
        <p>Ecuador</p>
        <span class="racetrack__number" id="cont_ECU">1</span>
      </button>
      <div class="collapse" id="collapse-ECU" bis_skin_checked="1">
        <div class="racetrack__event title" bis_skin_checked="1">
          <div class="t_time" bis_skin_checked="1">Time</div>
          <div class="t_racetrack" bis_skin_checked="1">Racetrack</div>
          <div bis_skin_checked="1">#</div> 
        </div>
        <div id="hip_collapse_ECU" bis_skin_checked="1">
        
    <div id="id_hip_923" class="racetrack__event racetr"  bis_skin_checked="1">
      <div class="id_mnu_crr_923" bis_skin_checked="1">4096 Min</div> 
      <div class="name" bis_skin_checked="1">Miguel Salem Dibo</div>
      <div bis_skin_checked="1">R1</div>    
    </div></div>
      </div></div>

          </div>
        <!-- </div> -->
    </section>
    <div class="limit" bis_skin_checked="0">
          <div class="limit-title" bis_skin_checked="0">Limite de apuestas(USD )</div>
          <div class="limit-ap" bis_skin_checked="0">
            <div class="nombre_hipodromo" bis_skin_checked="0">Penn National</div>
            <div class="t_race" bis_skin_checked="0">Race</div>
            <div class="carrera_actual" bis_skin_checked="0">1</div>
            <div bis_skin_checked="0">W/P/S</div>
            <div id="minapwps" bis_skin_checked="0">10</div>
            <div id="maxapwps" bis_skin_checked="0">100</div>
            <div bis_skin_checked="0">Exotica</div>
            <div id="minapexo" bis_skin_checked="0">20</div>
            <div id="maxapexo" bis_skin_checked="0">200</div>
          </div>
          <div class="limit-footer" bis_skin_checked="0">
            <div  bis_skin_checked="0">Monto máximo de pago por carrera:</div>
            <div bis_skin_checked="0">0.00</div>
          </div>
        </div>
    </section>
    
    <section class='main__center'>
<!-- <div class="panel__center" bis_skin_checked="1"> -->
        <div class="upcoming__title" bis_skin_checked="1"><i class="fa-regular fa-clock"></i> <span class="t_upc-races">Upcoming races</span></div>
        <div class="upcoming__races" id="upcoming_races" bis_skin_checked="1">
        <div id="id_hip2_23" class="upcoming__race USA" bis_skin_checked="1" style="">
          <img class="upcoming__img" src="https://d2zzz5z45zl95g.cloudfront.net/usr_imgs/flags/usa.png" alt="usa-img">
          <p class="upcoming__racetrack">Tampa Bay Downs R2</p>
          <p class="pulse">To start</p>
          <p>Pure blood</p>
        </div>
    
        <div id="id_hip2_22" class="upcoming__race USA" bis_skin_checked="1" style="">
          <img class="upcoming__img" src="https://d2zzz5z45zl95g.cloudfront.net/usr_imgs/flags/usa.png" alt="usa-img">
          <p class="upcoming__racetrack">Gulfstream Park R2</p>
          <div class="id_mnu_crr_22" bis_skin_checked="1">6 Min</div>
          <p>Pure blood</p>
        </div>
    
        <div id="id_hip2_553" class="upcoming__race CHL" bis_skin_checked="1" style="">
          <img class="upcoming__img" src="https://d2zzz5z45zl95g.cloudfront.net/usr_imgs/flags/chl.png" alt="chl-img">
          <p class="upcoming__racetrack">Club Hipico Santiago R8</p>
          <div class="id_mnu_crr_553" bis_skin_checked="1">6 Min</div>
          <p>Pure blood</p>
        </div>
    
        <div id="id_hip2_552" class="upcoming__race ARG" bis_skin_checked="1" style="">
          <img class="upcoming__img" src="https://d2zzz5z45zl95g.cloudfront.net/usr_imgs/flags/arg.png" alt="arg-img">
          <p class="upcoming__racetrack">Hipodromo de Palermo R1</p>
          <div class="id_mnu_crr_552" bis_skin_checked="1">12 Min</div>
          <p>Pure blood</p>
        </div>
    
        <div id="id_hip2_40" class="upcoming__race USA" bis_skin_checked="1" style="">
          <img class="upcoming__img" src="https://d2zzz5z45zl95g.cloudfront.net/usr_imgs/flags/usa.png" alt="usa-img">
          <p class="upcoming__racetrack">Laurel Park R2</p>
          <div class="id_mnu_crr_40" bis_skin_checked="1">12 Min</div>
          <p>Pure blood</p>
        </div>
    
        <div id="id_hip2_241" class="upcoming__race URU" bis_skin_checked="1" style="">
          <img class="upcoming__img" src="https://d2zzz5z45zl95g.cloudfront.net/usr_imgs/flags/uru.png" alt="uru-img">
          <p class="upcoming__racetrack">URU Las Piedras R1</p>
          <div class="id_mnu_crr_241" bis_skin_checked="1">12 Min</div>
          <p>Pure blood</p>
        </div>
    
        <div id="id_hip2_400" class="upcoming__race ENG" bis_skin_checked="1" style="">
          <img class="upcoming__img" src="https://d2zzz5z45zl95g.cloudfront.net/usr_imgs/flags/eng.png" alt="eng-img">
          <p class="upcoming__racetrack">UK Southwell R3</p>
          <div class="id_mnu_crr_400" bis_skin_checked="1">12 Min</div>
          <p>Pure blood</p>
        </div>
    
        <div id="id_hip2_24" class="upcoming__race USA" bis_skin_checked="1" style="">
          <img class="upcoming__img" src="https://d2zzz5z45zl95g.cloudfront.net/usr_imgs/flags/usa.png" alt="usa-img">
          <p class="upcoming__racetrack">Aqueduct R1</p>
          <div class="id_mnu_crr_24" bis_skin_checked="1">24 Min</div>
          <p>Pure blood</p>
        </div>
    
        <div id="id_hip2_330" class="upcoming__race SAF" bis_skin_checked="1" style="">
          <img class="upcoming__img" src="https://d2zzz5z45zl95g.cloudfront.net/usr_imgs/flags/saf.png" alt="saf-img">
          <p class="upcoming__racetrack">SAF Greyville R7</p>
          <div class="id_mnu_crr_330" bis_skin_checked="1">27 Min</div>
          <p>Pure blood</p>
        </div>
    
        <div id="id_hip2_397" class="upcoming__race IRE" bis_skin_checked="1" style="">
          <img class="upcoming__img" src="https://d2zzz5z45zl95g.cloudfront.net/usr_imgs/flags/ire.png" alt="ire-img">
          <p class="upcoming__racetrack">IRE Dundalk R5</p>
          <div class="id_mnu_crr_397" bis_skin_checked="1">27 Min</div>
          <p>Pure blood</p>
        </div>
    
        <div id="id_hip2_3" class="upcoming__race PR" bis_skin_checked="1" style="">
          <img class="upcoming__img" src="https://d2zzz5z45zl95g.cloudfront.net/usr_imgs/flags/pr.png" alt="pr-img">
          <p class="upcoming__racetrack">Camarero Race Track R1</p>
          <div class="id_mnu_crr_3" bis_skin_checked="1">29 Min</div>
          <p>Pure blood</p>
        </div>
    
        <div id="id_hip2_26" class="upcoming__race USA" bis_skin_checked="1" style="">
          <img class="upcoming__img" src="https://d2zzz5z45zl95g.cloudfront.net/usr_imgs/flags/usa.png" alt="usa-img">
          <p class="upcoming__racetrack">Oaklawn Park R1</p>
          <div class="id_mnu_crr_26" bis_skin_checked="1">44 Min</div>
          <p>Pure blood</p>
        </div>
    
        <div id="id_hip2_25" class="upcoming__race USA" bis_skin_checked="1" style="">
          <img class="upcoming__img" src="https://d2zzz5z45zl95g.cloudfront.net/usr_imgs/flags/usa.png" alt="usa-img">
          <p class="upcoming__racetrack">Fair Grounds R1</p>
          <div class="id_mnu_crr_25" bis_skin_checked="1">59 Min</div>
          <p>Pure blood</p>
        </div>
    
        <div id="id_hip2_9" class="upcoming__race USA" bis_skin_checked="1" style="">
          <img class="upcoming__img" src="https://d2zzz5z45zl95g.cloudfront.net/usr_imgs/flags/usa.png" alt="usa-img">
          <p class="upcoming__racetrack">Louisiana Downs R1</p>
          <div class="id_mnu_crr_9" bis_skin_checked="1">79 Min</div>
          <p>Pure blood</p>
        </div>
    
        <div id="id_hip2_34" class="upcoming__race USA" bis_skin_checked="1" style="">
          <img class="upcoming__img" src="https://d2zzz5z45zl95g.cloudfront.net/usr_imgs/flags/usa.png" alt="usa-img">
          <p class="upcoming__racetrack">Sunland Park R1</p>
          <div class="id_mnu_crr_34" bis_skin_checked="1">99 Min</div>
          <p>Pure blood</p>
        </div>
    
        <div id="id_hip2_31" class="upcoming__race USA" bis_skin_checked="1" style="">
          <img class="upcoming__img" src="https://d2zzz5z45zl95g.cloudfront.net/usr_imgs/flags/usa.png" alt="usa-img">
          <p class="upcoming__racetrack">Santa Anita R1</p>
          <div class="id_mnu_crr_31" bis_skin_checked="1">164 Min</div>
          <p>Pure blood</p>
        </div>
    
        <div id="id_hip2_21" class="upcoming__race USA" bis_skin_checked="1" style="">
          <img class="upcoming__img" src="https://d2zzz5z45zl95g.cloudfront.net/usr_imgs/flags/usa.png" alt="usa-img">
          <p class="upcoming__racetrack">Delta Downs R1</p>
          <div class="id_mnu_crr_21" bis_skin_checked="1">304 Min</div>
          <p>Pure blood</p>
        </div>
    
        <div id="id_hip2_27" class="upcoming__race USA" bis_skin_checked="1" style="">
          <img class="upcoming__img" src="https://d2zzz5z45zl95g.cloudfront.net/usr_imgs/flags/usa.png" alt="usa-img">
          <p class="upcoming__racetrack">Turfway Park R1</p>
          <div class="id_mnu_crr_27" bis_skin_checked="1">309 Min</div>
          <p>Pure blood</p>
        </div>
    
        <div id="id_hip2_388" class="upcoming__race NZ" bis_skin_checked="1" style="">
          <img class="upcoming__img" src="https://d2zzz5z45zl95g.cloudfront.net/usr_imgs/flags/nz.png" alt="nz-img">
          <p class="upcoming__racetrack">New Zealand Ellerslie R1</p>
          <div class="id_mnu_crr_388" bis_skin_checked="1">337 Min</div>
          <p>Pure blood</p>
        </div>
    
        <div id="id_hip2_456" class="upcoming__race NZ" bis_skin_checked="1" style="">
          <img class="upcoming__img" src="https://d2zzz5z45zl95g.cloudfront.net/usr_imgs/flags/nz.png" alt="nz-img">
          <p class="upcoming__racetrack">New Zealand Plymouth R1</p>
          <div class="id_mnu_crr_456" bis_skin_checked="1">352 Min</div>
          <p>Pure blood</p>
        </div>
    
        <div id="id_hip2_4" class="upcoming__race USA" bis_skin_checked="1" style="">
          <img class="upcoming__img" src="https://d2zzz5z45zl95g.cloudfront.net/usr_imgs/flags/usa.png" alt="usa-img">
          <p class="upcoming__racetrack">Charles Town R1</p>
          <div class="id_mnu_crr_4" bis_skin_checked="1">374 Min</div>
          <p>Pure blood</p>
        </div>
    
        <div id="id_hip2_585" class="upcoming__race JPN" bis_skin_checked="1">
          <img class="upcoming__img" src="https://d2zzz5z45zl95g.cloudfront.net/usr_imgs/flags/jpn.png" alt="jpn-img">
          <p class="upcoming__racetrack">JPN Tokyo City R1</p>
          <div class="id_mnu_crr_585" bis_skin_checked="1">444 Min</div>
          <p>Pure blood</p>
        </div>
    
        <div id="id_hip2_588" class="upcoming__race AUS" bis_skin_checked="1" style="">
          <img class="upcoming__img" src="https://d2zzz5z45zl95g.cloudfront.net/usr_imgs/flags/aus.png" alt="aus-img">
          <p class="upcoming__racetrack">Sandown AUS R1</p>
          <div class="id_mnu_crr_588" bis_skin_checked="1">449 Min</div>
          <p>Pure blood</p>
        </div>
    
        <div id="id_hip2_231" class="upcoming__race AUS" bis_skin_checked="1" style="">
          <img class="upcoming__img" src="https://d2zzz5z45zl95g.cloudfront.net/usr_imgs/flags/aus.png" alt="aus-img">
          <p class="upcoming__racetrack">Townsville R1</p>
          <div class="id_mnu_crr_231" bis_skin_checked="1">453 Min</div>
          <p>Pure blood</p>
        </div>
    
        <div id="id_hip2_211" class="upcoming__race AUS" bis_skin_checked="1" style="">
          <img class="upcoming__img" src="https://d2zzz5z45zl95g.cloudfront.net/usr_imgs/flags/aus.png" alt="aus-img">
          <p class="upcoming__racetrack">Rosehill R1</p>
          <div class="id_mnu_crr_211" bis_skin_checked="1">464 Min</div>
          <p>Pure blood</p>
        </div>
    
        <div id="id_hip2_600" class="upcoming__race AUS" bis_skin_checked="1" style="">
          <img class="upcoming__img" src="https://d2zzz5z45zl95g.cloudfront.net/usr_imgs/flags/aus.png" alt="aus-img">
          <p class="upcoming__racetrack">Morphettville R1</p>
          <div class="id_mnu_crr_600" bis_skin_checked="1">491 Min</div>
          <p>Pure blood</p>
        </div>
    
        <div id="id_hip2_477" class="upcoming__race AUS" bis_skin_checked="1" style="">
          <img class="upcoming__img" src="https://d2zzz5z45zl95g.cloudfront.net/usr_imgs/flags/aus.png" alt="aus-img">
          <p class="upcoming__racetrack">Kyneton R1</p>
          <div class="id_mnu_crr_477" bis_skin_checked="1">495 Min</div>
          <p>Pure blood</p>
        </div>
    
        <div id="id_hip2_180" class="upcoming__race AUS" bis_skin_checked="1" style="">
          <img class="upcoming__img" src="https://d2zzz5z45zl95g.cloudfront.net/usr_imgs/flags/aus.png" alt="aus-img">
          <p class="upcoming__racetrack">AUS Doomben R1</p>
          <div class="id_mnu_crr_180" bis_skin_checked="1">507 Min</div>
          <p>Pure blood</p>
        </div>
    
        <div id="id_hip2_181" class="upcoming__race AUS" bis_skin_checked="1" style="">
          <img class="upcoming__img" src="https://d2zzz5z45zl95g.cloudfront.net/usr_imgs/flags/aus.png" alt="aus-img">
          <p class="upcoming__racetrack">AUS Newcastle R1</p>
          <div class="id_mnu_crr_181" bis_skin_checked="1">519 Min</div>
          <p>Pure blood</p>
        </div>
    
        <div id="id_hip2_266" class="upcoming__race AUS" bis_skin_checked="1" style="">
          <img class="upcoming__img" src="https://d2zzz5z45zl95g.cloudfront.net/usr_imgs/flags/aus.png" alt="aus-img">
          <p class="upcoming__racetrack">Sapphire Coast R1</p>
          <div class="id_mnu_crr_266" bis_skin_checked="1">545 Min</div>
          <p>Pure blood</p>
        </div>
    
        <div id="id_hip2_178" class="upcoming__race AUS" bis_skin_checked="1" style="">
          <img class="upcoming__img" src="https://d2zzz5z45zl95g.cloudfront.net/usr_imgs/flags/aus.png" alt="aus-img">
          <p class="upcoming__racetrack">Ascot R1</p>
          <div class="id_mnu_crr_178" bis_skin_checked="1">573 Min</div>
          <p>Pure blood</p>
        </div>
    
        <div id="id_hip2_219" class="upcoming__race AUS" bis_skin_checked="1" style="">
          <img class="upcoming__img" src="https://d2zzz5z45zl95g.cloudfront.net/usr_imgs/flags/aus.png" alt="aus-img">
          <p class="upcoming__racetrack">Tamworth R1</p>
          <div class="id_mnu_crr_219" bis_skin_checked="1">575 Min</div>
          <p>Pure blood</p>
        </div>
    
        <div id="id_hip2_174" class="upcoming__race AUS" bis_skin_checked="1" style="">
          <img class="upcoming__img" src="https://d2zzz5z45zl95g.cloudfront.net/usr_imgs/flags/aus.png" alt="aus-img">
          <p class="upcoming__racetrack">Gold Coast R1</p>
          <div class="id_mnu_crr_174" bis_skin_checked="1">593 Min</div>
          <p>Pure blood</p>
        </div>
    
        <div id="id_hip2_562" class="upcoming__race AUS" bis_skin_checked="1" style="">
          <img class="upcoming__img" src="https://d2zzz5z45zl95g.cloudfront.net/usr_imgs/flags/aus.png" alt="aus-img">
          <p class="upcoming__racetrack">Darwin R1</p>
          <div class="id_mnu_crr_562" bis_skin_checked="1">684 Min</div>
          <p>Pure blood</p>
        </div>
    
        <div id="id_hip2_542" class="upcoming__race AUS" bis_skin_checked="1" style="">
          <img class="upcoming__img" src="https://d2zzz5z45zl95g.cloudfront.net/usr_imgs/flags/aus.png" alt="aus-img">
          <p class="upcoming__racetrack">Esperance R1</p>
          <div class="id_mnu_crr_542" bis_skin_checked="1">696 Min</div>
          <p>Pure blood</p>
        </div>
    
        <div id="id_hip2_741" class="upcoming__race FRA" bis_skin_checked="1" style="">
          <img class="upcoming__img" src="https://d2zzz5z45zl95g.cloudfront.net/usr_imgs/flags/fra.png" alt="fra-img">
          <p class="upcoming__racetrack">Deauville R1</p>
          <div class="id_mnu_crr_741" bis_skin_checked="1">1152 Min</div>
          <p>Pure blood</p>
        </div>
    
        <div id="id_hip2_915" class="upcoming__race JAM" bis_skin_checked="1" style="">
          <img class="upcoming__img" src="https://d2zzz5z45zl95g.cloudfront.net/usr_imgs/flags/jam.png" alt="jam-img">
          <p class="upcoming__racetrack">Caymanas Park R1</p>
          <div class="id_mnu_crr_915" bis_skin_checked="1">1394 Min</div>
          <p>Pure blood</p>
        </div>
    
        <div id="id_hip2_923" class="upcoming__race ECU" bis_skin_checked="1" style="">
          <img class="upcoming__img" src="https://d2zzz5z45zl95g.cloudfront.net/usr_imgs/flags/ecu.png" alt="ecu-img">
          <p class="upcoming__racetrack">Miguel Salem Dibo R1</p>
          <div class="id_mnu_crr_923" bis_skin_checked="1">2924 Min</div>
          <p>Pure blood</p>
        </div>
    </div>

        <div class="race" bis_skin_checked="1">

          <div class="race__data" bis_skin_checked="1">
            <img src="https://www.universalhorse.club/img/iconos/caballo2.png" alt="horse-img">
            <div class="nombre_hipodromo" bis_skin_checked="1">UK Catterick Bridge</div>
            <div class="fecha_crr" bis_skin_checked="1">31/01/2025</div>
          </div>

          <div class="race__nraces" bis_skin_checked="1">
                <div bis_skin_checked="1"><span class="t_races">Races</span> :</div>
                <div class="race__nraces--active" id="all_btn_races" bis_skin_checked="1">
                  <div class="race__nraces--active" id="race_results" bis_skin_checked="1"></div>
                  <div class="race__nraces--active" id="carreras_activas" bis_skin_checked="1"><button class="btn nrace active">7</button></div>
                </div>
              </div>

          <div class="race__time-programs" bis_skin_checked="1">
            <div class="race__time" bis_skin_checked="1">
                  <div bis_skin_checked="1"><span class="t_s-time">Start time</span> :</div>
                  <div class="hora_inicio" bis_skin_checked="1">11:03:00</div>
                  <div bis_skin_checked="1"> / </div>
                  <div bis_skin_checked="1"><span class="t_start-in">Starting in</span> :</div>
                  <div class="race__start-in" bis_skin_checked="1">0-1:58:27</div>
            </div>
            <div class="race__programs" bis_skin_checked="1">            
              <div bis_skin_checked="1"><span class="t_programs">Programs</span> :</div>
              <div class="race__programs" id="gacetas" bis_skin_checked="1">No available</div>
            </div>
          </div>
           
          <div class="race__type-bet" id="nav-tab" role="tablist" bis_skin_checked="1">
            <button class="btn type-bet active" id="pills-wps-tab" data-bs-toggle="tab" data-bs-target="#pills-wps" style="display: block;">W/P/S</button>
            <button class="btn type-bet" id="pills-exacta-tab" data-bs-toggle="tab" data-bs-target="#pills-exacta" style="display: block;">Exacta</button>
            <button class="btn type-bet" id="pills-trifecta-tab" data-bs-toggle="tab" data-bs-target="#pills-trifecta" style="display: block;">Trifecta</button>
            <button class="btn type-bet" id="pills-superfecta-tab" data-bs-toggle="tab" data-bs-target="#pills-superfecta" style="display: block;">Superfecta</button>
            <button class="btn type-bet" id="pills-cuotafija-tab" data-bs-toggle="tab" data-bs-target="#pills-winifjo" style="display: none;">Cuota Fija</button>
            <button class="btn type-bet" id="pills-pick2-tab" data-bs-toggle="tab" data-bs-target="#pills-pick2" style="display: none;">Pick 2</button>
            <button class="btn type-bet" id="pills-pick3-tab" data-bs-toggle="tab" data-bs-target="#pills-pick3" style="display: none;">Pick 3</button>
          </div>

          <div class="tab-content" id="bet_types_container" bis_skin_checked="1">
            <div class="tab-pane fade show active wps_2" id="pills-wps" bis_skin_checked="1">
              <div class="race__wps titles" bis_skin_checked="1">
                <div class="t_win cls_w" bis_skin_checked="1" style="display: block;">Win</div>
                <div class="t_place cls_p" bis_skin_checked="1" style="display: block;">Place</div>
                <div class="t_show cls_s" bis_skin_checked="1" style="display: none;">Show</div>
                <div class="" bis_skin_checked="1">NP</div>
                <div class="" bis_skin_checked="1">Montador</div>
                <div class="" bis_skin_checked="1">Entrenador</div>
                <div class="" bis_skin_checked="1">Peso</div>
                <div class="" bis_skin_checked="1">Med.</div>
                <div class="" bis_skin_checked="1">M/L</div>
              </div>
              <div class="race__container-races" id="cab_wps" bis_skin_checked="1">
      <div class="race__wps" bis_skin_checked="1">
        <input class="ipt t_ph-win cls_w" placeholder="Win" type="number" id="_w_10780859_" autocomplete="off" data-raider="10780859,w,1,CAB,Kazar Forez,WIN" style="display: block;">
        <input class="ipt t_ph-place cls_p" placeholder="Place" type="number" id="_p_10780859_" autocomplete="off" data-raider="10780859,p,1,CAB,Kazar Forez,PLACE" style="display: block;">
        <input class="ipt t_ph-show cls_s" placeholder="Show" type="number" id="_s_10780859_" autocomplete="off" data-raider="10780859,s,1,CAB,Kazar Forez,SHOW" style="display: none;">
        
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
      <div class="race__wps" bis_skin_checked="1">
        <input class="ipt t_ph-win cls_w" placeholder="Win" type="number" id="_w_10780860_" autocomplete="off" data-raider="10780860,w,2,CAB,Balcomie Breeze,WIN" style="display: block;">
        <input class="ipt t_ph-place cls_p" placeholder="Place" type="number" id="_p_10780860_" autocomplete="off" data-raider="10780860,p,2,CAB,Balcomie Breeze,PLACE" style="display: block;">
        <input class="ipt t_ph-show cls_s" placeholder="Show" type="number" id="_s_10780860_" autocomplete="off" data-raider="10780860,s,2,CAB,Balcomie Breeze,SHOW" style="display: none;">
        
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
      <div class="race__wps" bis_skin_checked="1">
        <input class="ipt t_ph-win cls_w" placeholder="Win" type="number" id="_w_10780861_" autocomplete="off" data-raider="10780861,w,3,CAB,Lahire,WIN" style="display: block;">
        <input class="ipt t_ph-place cls_p" placeholder="Place" type="number" id="_p_10780861_" autocomplete="off" data-raider="10780861,p,3,CAB,Lahire,PLACE" style="display: block;">
        <input class="ipt t_ph-show cls_s" placeholder="Show" type="number" id="_s_10780861_" autocomplete="off" data-raider="10780861,s,3,CAB,Lahire,SHOW" style="display: none;">
        
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
      <div class="race__wps" bis_skin_checked="1">
        <input class="ipt t_ph-win cls_w" placeholder="Win" type="number" id="_w_10780862_" autocomplete="off" data-raider="10780862,w,4,CAB,Little Pi,WIN" style="display: block;">
        <input class="ipt t_ph-place cls_p" placeholder="Place" type="number" id="_p_10780862_" autocomplete="off" data-raider="10780862,p,4,CAB,Little Pi,PLACE" style="display: block;">
        <input class="ipt t_ph-show cls_s" placeholder="Show" type="number" id="_s_10780862_" autocomplete="off" data-raider="10780862,s,4,CAB,Little Pi,SHOW" style="display: none;">
        
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
      <div class="race__wps" bis_skin_checked="1">
        <input class="ipt t_ph-win cls_w" placeholder="Win" type="number" id="_w_10780863_" autocomplete="off" data-raider="10780863,w,5,CAB,Kellies Dream,WIN" style="display: block;">
        <input class="ipt t_ph-place cls_p" placeholder="Place" type="number" id="_p_10780863_" autocomplete="off" data-raider="10780863,p,5,CAB,Kellies Dream,PLACE" style="display: block;">
        <input class="ipt t_ph-show cls_s" placeholder="Show" type="number" id="_s_10780863_" autocomplete="off" data-raider="10780863,s,5,CAB,Kellies Dream,SHOW" style="display: none;">
        
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
      <div class="race__wps" bis_skin_checked="1">
        <input class="ipt t_ph-win cls_w" placeholder="Win" type="number" id="_w_10780864_" autocomplete="off" data-raider="10780864,w,6,CAB,Kuma Beach,WIN" style="display: block;">
        <input class="ipt t_ph-place cls_p" placeholder="Place" type="number" id="_p_10780864_" autocomplete="off" data-raider="10780864,p,6,CAB,Kuma Beach,PLACE" style="display: block;">
        <input class="ipt t_ph-show cls_s" placeholder="Show" type="number" id="_s_10780864_" autocomplete="off" data-raider="10780864,s,6,CAB,Kuma Beach,SHOW" style="display: none;">
        
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
      <div class="race__wps" bis_skin_checked="1">
        <input class="ipt t_ph-win cls_w" placeholder="Win" type="number" id="_w_10780865_" autocomplete="off" data-raider="10780865,w,7,CAB,Admiral Fitz,WIN" style="display: block;">
        <input class="ipt t_ph-place cls_p" placeholder="Place" type="number" id="_p_10780865_" autocomplete="off" data-raider="10780865,p,7,CAB,Admiral Fitz,PLACE" style="display: block;">
        <input class="ipt t_ph-show cls_s" placeholder="Show" type="number" id="_s_10780865_" autocomplete="off" data-raider="10780865,s,7,CAB,Admiral Fitz,SHOW" style="display: none;">
        
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
      <div class="race__wps" bis_skin_checked="1">
        <input class="ipt t_ph-win cls_w" placeholder="Win" type="number" id="_w_10780866_" autocomplete="off" data-raider="10780866,w,8,CAB,Inoue,WIN" style="display: block;">
        <input class="ipt t_ph-place cls_p" placeholder="Place" type="number" id="_p_10780866_" autocomplete="off" data-raider="10780866,p,8,CAB,Inoue,PLACE" style="display: block;">
        <input class="ipt t_ph-show cls_s" placeholder="Show" type="number" id="_s_10780866_" autocomplete="off" data-raider="10780866,s,8,CAB,Inoue,SHOW" style="display: none;">
        
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
      <div class="race__exacta " bis_skin_checked="1"><input class="chk exacta_1" type="checkbox" ><input class="chk exacta_2" type="checkbox" >
        
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
      <div class="race__exacta " bis_skin_checked="1"><input class="chk exacta_1" type="checkbox" ><input class="chk exacta_2" type="checkbox" >
        
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
      <div class="race__exacta " bis_skin_checked="1"><input class="chk exacta_1" type="checkbox" ><input class="chk exacta_2" type="checkbox" >
        
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
      <div class="race__exacta " bis_skin_checked="1"><input class="chk exacta_1" type="checkbox" ><input class="chk exacta_2" type="checkbox" >
        
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
      <div class="race__exacta " bis_skin_checked="1"><input class="chk exacta_1" type="checkbox" ><input class="chk exacta_2" type="checkbox" >
        
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
      <div class="race__exacta " bis_skin_checked="1"><input class="chk exacta_1" type="checkbox" ><input class="chk exacta_2" type="checkbox" >
        
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
      <div class="race__exacta " bis_skin_checked="1"><input class="chk exacta_1" type="checkbox" ><input class="chk exacta_2" type="checkbox" >
        
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
      <div class="race__exacta " bis_skin_checked="1"><input class="chk exacta_1" type="checkbox" ><input class="chk exacta_2" type="checkbox" >
        
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
      <div class="race__trifecta " bis_skin_checked="1"><input class="chk trifecta_1" type="checkbox" ><input class="chk trifecta_2" type="checkbox" ><input class="chk trifecta_3" type="checkbox" >
        
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
      <div class="race__trifecta " bis_skin_checked="1"><input class="chk trifecta_1" type="checkbox" ><input class="chk trifecta_2" type="checkbox" ><input class="chk trifecta_3" type="checkbox" >
        
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
      <div class="race__trifecta " bis_skin_checked="1"><input class="chk trifecta_1" type="checkbox" ><input class="chk trifecta_2" type="checkbox" ><input class="chk trifecta_3" type="checkbox" >
        
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
      <div class="race__trifecta " bis_skin_checked="1"><input class="chk trifecta_1" type="checkbox" ><input class="chk trifecta_2" type="checkbox" ><input class="chk trifecta_3" type="checkbox" >
        
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
      <div class="race__trifecta " bis_skin_checked="1"><input class="chk trifecta_1" type="checkbox" ><input class="chk trifecta_2" type="checkbox" ><input class="chk trifecta_3" type="checkbox" >
        
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
      <div class="race__trifecta " bis_skin_checked="1"><input class="chk trifecta_1" type="checkbox" ><input class="chk trifecta_2" type="checkbox" ><input class="chk trifecta_3" type="checkbox">
        
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
      <div class="race__trifecta " bis_skin_checked="1"><input class="chk trifecta_1" type="checkbox" ><input class="chk trifecta_2" type="checkbox" ><input class="chk trifecta_3" type="checkbox" >
        
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
      <div class="race__trifecta " bis_skin_checked="1"><input class="chk trifecta_1" type="checkbox" ><input class="chk trifecta_2" type="checkbox" ><input class="chk trifecta_3" type="checkbox" >
        
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
      <div class="race__superfecta " bis_skin_checked="1"><input class="chk superfecta_1" type="checkbox" ><input class="chk superfecta_2" type="checkbox" ><input class="chk superfecta_3" type="checkbox" ><input class="chk superfecta_4" type="checkbox" >
        
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
      <div class="race__superfecta " bis_skin_checked="1"><input class="chk superfecta_1" type="checkbox" ><input class="chk superfecta_2" type="checkbox" ><input class="chk superfecta_3" type="checkbox" ><input class="chk superfecta_4" type="checkbox" >
        
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
      <div class="race__superfecta " bis_skin_checked="1"><input class="chk superfecta_1" type="checkbox" ><input class="chk superfecta_2" type="checkbox" ><input class="chk superfecta_3" type="checkbox" ><input class="chk superfecta_4" type="checkbox" >
        
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
      <div class="race__superfecta " bis_skin_checked="1"><input class="chk superfecta_1" type="checkbox" ><input class="chk superfecta_2" type="checkbox" ><input class="chk superfecta_3" type="checkbox" ><input class="chk superfecta_4" type="checkbox" >
        
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
      <div class="race__superfecta " bis_skin_checked="1"><input class="chk superfecta_1" type="checkbox" ><input class="chk superfecta_2" type="checkbox" ><input class="chk superfecta_3" type="checkbox" ><input class="chk superfecta_4" type="checkbox" >
        
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
      <div class="race__superfecta " bis_skin_checked="1"><input class="chk superfecta_1" type="checkbox" ><input class="chk superfecta_2" type="checkbox" ><input class="chk superfecta_3" type="checkbox" ><input class="chk superfecta_4" type="checkbox" >
        
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
      <div class="race__superfecta " bis_skin_checked="1"><input class="chk superfecta_1" type="checkbox" ><input class="chk superfecta_2" type="checkbox" ><input class="chk superfecta_3" type="checkbox" ><input class="chk superfecta_4" type="checkbox" >
        
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
      <div class="race__superfecta " bis_skin_checked="1"><input class="chk superfecta_1" type="checkbox" ><input class="chk superfecta_2" type="checkbox" ><input class="chk superfecta_3" type="checkbox" ><input class="chk superfecta_4" type="checkbox" >
        
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

<div class="accordion" id="accordionExample">
  {#each allCountries as country, countryIndex}
    <div class="accordion-item">
      <!-- <h2 class="accordion-header"> -->
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target={`#collapse${countryIndex}`} aria-expanded="false" aria-controls={`collapse${countryIndex}`}>
          carreras: {country.pais} - cantidad: {country.cantidad}
        </button>
      <!-- </h2> -->
      <div id={`collapse${countryIndex}`} class="accordion-collapse collapse" data-bs-parent="#accordionExample">
        <div class="accordion-body">
          <strong>Carreras en {country.pais}:</strong>
          <ul>
            {#each (country.carreras ??[] ) as carrera}
              <li>Time: {carrera.time} - Racetrack: {carrera.name_pista} - #: {carrera.crr}</li>
            {/each}
          </ul>
        </div>
      </div>
    </div>
  {/each}
</div>
