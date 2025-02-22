<script lang="ts">
  import './page.css';
  import Header from './Header.svelte';
  import 'bootstrap/dist/css/bootstrap.min.css';
  import 'bootstrap/dist/js/bootstrap.bundle.min.js';
  import { data } from './horses.js';
  import { getRacetracksByCountry, countryArray } from './function.js';
  let user = $state<{ name: string }>();
  getRacetracksByCountry(data);


  let allCountries = $state<{ pais: string; cantidad: number; carreras?: any[] }[]>([]);
  $effect(() => {
    allCountries = countryArray.flatMap((typeEntry: { tipo: number; paises: { pais: string; cantidad: number; carreras?: any[] }[] }) => typeEntry.paises);
  });
  
</script>
<div class="accordion" id="accordionExample">
  {#each allCountries as country, countryIndex}
    <div class="accordion-item">
      <h2 class="accordion-header">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target={`#collapse${countryIndex}`} aria-expanded="false" aria-controls={`collapse${countryIndex}`}>
          carreras: {country.pais} - cantidad: {country.cantidad}
        </button>
      </h2>
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
