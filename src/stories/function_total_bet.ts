


function total_bs(){
    var to  =0;
    $(".bts[name='vta[]']").each(function(indice, elemento) {
      to=to+parseFloat($(elemento).html());
    });

    $('#bettotal').html(number_format(to,2));
    $('#betjugada').html(Jugada.length);
    

    if (to > limite_tck && limite_tck > 0){
        mensaje('error','multiple',leng["lim_jug_exe"]+"\n"+leng["verifique"]);     
    }
    return to;
}

//FUNCION 1 PARA IMPRIMIR APUESTAS (WPS) //////// LISTO UWU
//------------------------------------------------------------------------------

function agrega_bet_slip(id_bet,bslm,nom,m,cbn,idj,tpj){//bet WSP
  let vta=`
  <div class="betslip__bet" id="${id_bet}">
      <div class="betslip__typebet">
        <div>${tpj}</div>
        <button class="btn bet-delete" onclick="elimina_jugada('${bslm}','${id_bet.match(/_(.*?)_/)[1]}','${id_bet}');"><i class="fas fa-close"></i></button> 
      </div>
      <div>${$(".nombre_hipodromo").eq(0).text()} - R${$(".carrera_actual").text()}</div>
      <div></div>
      <div>${cbn}.- <span class="betslip__rider">${nom}</span></div>
      <div class="betslip__amount"><span class="t_amount">Monto</span>: <span id="${bslm}" class="bts betslip__amount--number" name="vta[]" >${m}</span></div>
    </div>`;
  $('#cabbetslip').append(vta);   
}

//FUNCION 2 PARA IMPRIMIR APUESTAS (EXOTICA)
//------------------------------------------------------------------------------

function agrega_bet_slip_exotica(id_bet,bslm,nom,m,cbn,idj,tpj,idh,func,ftp){
  let vta=`
    <div class="betslip__bet" id="${id_bet}">
      <div class="betslip__typebet">
        <div>${tpj}</div>
        <button class="btn bet-delete" onclick="elimina_jugada('${bslm}','${id_bet.match(/_(.*?)_/)[1]}','${id_bet}');"><i class="fas fa-close"></i></button>        
      </div>
      <div>${$(".nombre_hipodromo").eq(0).text()} - R${$(".carrera_actual").text()}</div>
      <div id="${idj}">${nom}</div>
      <div>
        <div id="${bslm}" class="bts" name="vta[]" hidden></div>
        <div class="betslip__amount">
          <span class="t_amount">Monto</span>: 
          <input class="ipt" type="number" id="mon_${ftp}_${idh}" data-typebet="${func},${idh},${ftp}" autocomplete="off">
        </div>
      </div>
    </div>`;         
   //onkeydown="return soloNumeros(event); onkeypress="${func}('${idh}','${ftp}');"  onkeyup="${func}('${idh}','${ftp}');" 
  $('#cabbetslip').append(vta);   
  setTimeout(() => { $('#betjugada').html(Jugada.length);}, 100);//par aactualar el lenght de nmanera correcta
}

//FUNCION 3 PARA IMPRIMIR APUESTAS (POLLA)
//------------------------------------------------------------------------------
function agrega_bet_slip_polla(id_bet,bslm,nom,m,cbn,idj,tpj){
        
  var vta=`<ul class="list-hipodro-ul4" id="${id_bet}">
                      <li>
                          Carr#${cbn}
                      </li>
                      <li>${nom}</li>
                      <li>${tpj}</li>
                      <li class="bts"></li>
                      <li></li>         
             </ul>`;

$('#cabbetslip').append(vta);   
}

//------------------------------------------------------------------------------

function limpiar(){
  $('#cabbetslip').html('');
  $("#bet_types_container input[type='number']").val("");
  $("#bet_types_container input[type='checkbox']").prop("checked", false);

  Jugada=[];
  tmp_sel_cab1 = [];
  tmp_sel_cab2 = [];
  tmp_sel_cab3 = [];
  tmp_sel_cab4 = [];
  tmp_sel_cab5 = [];
  tmp_sel_cab6 = [];
  $('#betjugada').html('0');
  $('#bettotal').html('0.00');
}

//------------------------------------------------------------------------------

