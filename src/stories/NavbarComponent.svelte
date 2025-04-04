<script lang="ts">
    import "./navbar.css"
    import '@fortawesome/fontawesome-free/css/all.min.css'
</script>

<header class="navbar">
  <!-- Logo -->
  <div class="navbar__logo">
    <img src="https://cdn-icons-png.flaticon.com/512/616/616408.png" alt="Horse Logo" />
    
  </div>

  <!-- Botones -->
  <div class="navbar__center">
    <button class="btn"><i class="fas fa-print"></i> Reimprimir</button>
    <button class="btn"><i class="fas fa-address-book"></i> Lista de usuarios</button>
    <button class="btn notification">
      <i class="fas fa-shopping-bag"></i> Autoservicio
      <span class="notification__count">1</span>
    </button>
    <button class="btn"><i class="fas fa-cash-register"></i> Cuadre de caja</button>
    <button class="btn"><i class="fas fa-book"></i> Apuestas realizadas</button>
    <button class="btn"><i class="fas fa-redo-alt"></i></button>
  </div>

  <!-- Info blocks -->
  <div class="navbar__info">
    <div class="info-block">
      <span class="info-label dark">Ticket verify</span>
      <input type="number" placeholder="Código" />
    </div>
    <div class="info-block">
      <span class="info-label dark">Cod. Agent:</span>
      <span class="info-value light">6008-4439</span>
    </div>
    <div class="info-block">
      <span class="info-label dark">User:</span>
      <span class="info-value light">cjferia1</span>
    </div>
    <div class="info-block">
      <span class="info-label dark">Balance</span>
      <span class="info-value light"><span class="balance">231.00</span> PEN</span>
    </div>
  </div>
</header>

  

<!-- <header class="header"> -->
    <!-- <div class="header__logo"> -->
        <!-- puede que esto s epueda llevar todo a JS -->
      <!-- <img src="https://d2zzz5z45zl95g.cloudfront.net/usr_imgs/logo.png" alt="logo-universal"> -->
    <!-- </div> -->
    <!-- <div class="header__options--center"> -->
      <!-- Reimprimir | Lista de usuarios | Autoservicios | Cuadre de caja | Apuestas realizadas | Recargar(pagina) -->
      <!-- <button class="btn option" title="Reimprimir" onclick="if (!window.__cfRLUnblockHandlers) return false; imprime_reporte2('re','1')"><i class="fas fa-print"></i></button> -->
      <!-- <button class="btn option" title="Lista de usuarios" onclick="if (!window.__cfRLUnblockHandlers) return false; abre_listas_usuarios()"><i class="fas fa-address-book"></i></button> -->
      <!-- <button class="btn option notification" title="Autoservicios" data-bs-toggle="modal" data-bs-target="#user-autoservice" onclick="if (!window.__cfRLUnblockHandlers) return false; viewTicketsAutoservice()"><i class="fas fa-shopping-cart"></i><input class="autoservice__count" id="autoservice-count" type="text" value="0"></button> -->
      <!-- <button class="btn option" title="Cuadre de caja"><i class="fas fa-cash-register"></i></button> -->
      <!-- <button class="btn option" title="Apuestas realizadas" data-bs-toggle="modal" data-bs-target="#ap_realizadas" onclick="if (!window.__cfRLUnblockHandlers) return false; viewBetsPlaced();"><i class="fas fa-book"></i></button> -->
      <!-- <button class="btn option" title="Recargar" onclick="if (!window.__cfRLUnblockHandlers) return false; location.reload();"><i class="fas fa-redo-alt"></i></button> -->
      
      <!-- <div> -->
        <!-- <div class="header__text t_verif-tck">Ticket verify</div> -->
        <!-- <input class="ipt data t_code" id="ticket_verify" onkeyup="if (!window.__cfRLUnblockHandlers) return false; searchTicket(this,event)" type="number" min="0" placeholder="Código"> -->
      <!-- </div> -->

      <!-- <div> -->
        <!-- <div class="header__text t_c-agent">Cod. Agent :</div> -->
        <!-- <div class="ipt data">6008-4439</div> -->
      <!-- </div> -->
    <!-- </div> -->
    <!-- <div class="header__options"> -->
      <!-- <div> -->
        <!-- <div class="header__text t_user">User</div> -->
        <!-- <div class="ipt data">cjferia1</div> -->
      <!-- </div> -->
      <!-- <div> -->
        <!-- <div class="header__text t_bal">Balance</div> -->
        <!-- <div class="ipt data user-saldo-balance">224.00 <span class="currency">PEN</span></div> -->
      <!-- </div> -->
      <!--select class="input pais" name="" id="">
        <option value="" selected>ES</option>
        <option value="">EN</option>
      </select-->
    <!-- </div> -->
    
  <!-- </header> -->