<?php
//ini_set("session.cookie_lifetime","36000");
//$lifer=400000;
session_start();
//setcookie(session_name(),session_id(),time()+$lifer);

if(!isset($_SESSION['id'])){
    session_destroy();
    echo "<script>window.parent.location='index.php'</script>";
}

require 'modelo/class_datos.php';

#$url="144.217.251.221";
$url="51.222.218.97";
$path="betapi/bet_api.php";

//$url="lottohipico.com";
//$path="n19/opt/betapi/bet_api.php";

//$url="127.0.0.1:8080";
//$path="n19c/opt/betapi/bet_api.php";

if ($accion==='ini'){
hjons
if (isset($_POST['tipo'])){ 

        $serv_li = "bws2.miapuesta.vip";
        
}else{
    $serv_li = "bws2.universalrace.net";
}
	
	//$serv_li = "185.144.157.19:$rand";
    //$serv_li = "144.217.208.118:4030";
    //$serv_li = "127.0.0.1:4030";
    
    $teclado="f";
    if (isset($_SESSION['per_teclacado'])){
        $teclado=$_SESSION['per_teclacado'];
    }else{
        $teclado="f";
    }

    if (isset($_POST['toff'])){
        
        $token=$_SESSION['token'];
        if ($token!==''){
            $toff=filter_input(INPUT_POST,'toff');
            $tmz=filter_input(INPUT_POST,'tmz');
            $tp_usuario=$_SESSION['tp_user'];
	    $betapi = new data_Connect("http",$url,$path);
            $results=$betapi->set_tmz($token,$toff,$tmz,$tp_usuario);    
        }
    }
    
    echo "{ "
    . "\"min_ap\":$_SESSION[ap_min_cab],"
    . "\"limite_tck\":$_SESSION[max_tck],"
    . "\"ser_li\":\"$serv_li\","
    . "\"direccion_local\":\"127.0.0.1\","
    . "\"margen_izq\":2,"
    . "\"puerto\":5050,"
    . "\"saldo\":$_SESSION[saldo],"
    . "\"token\":\"$_SESSION[token]\","        
    . "\"usuario\":\"$_SESSION[usuario]\","
    . "\"id_us\":\"$_SESSION[id]\","
    . "\"teclado\":\"$teclado\","
    . "\"simbolo\":\"$_SESSION[simbolo]\","
    . "\"nivel\":\"$_SESSION[nivel]\"    
    }";
    
    return;
   
}

if ($accion==='retirados'){
    
    $path="betapi/bet_api_cab2.php";
    $betapi = new data_Connect("http",$url,$path);
    
    $token=$_SESSION['token'];
    $idt=filter_input(INPUT_POST,'hip');
    $cr=filter_input(INPUT_POST,'crr');    
    
    $results=$betapi->retirados($token,$idt,$cr);
    echo $results;   
    return;
}

if ($accion==='chpk2'){
    $path="betapi/bet_api_cab2.php";
    $betapi = new data_Connect("http",$url,$path);
    $token=$_SESSION['token'];
    $idt=filter_input(INPUT_POST,'idt');
    $tr=filter_input(INPUT_POST,'tr');
    $cr=filter_input(INPUT_POST,'cr');
    $id_crr=filter_input(INPUT_POST,'id_crr');
    

    $results=$betapi->chpk2($token,$idt,$tr,$cr,$id_crr);

    //print_r($results);
    echo $results;   
    return;
}

if ($accion==='apr'){

    $betapi = new data_Connect("http",$url,$path);
    $token=$_SESSION['token'];
    $xfecha=filter_input(INPUT_POST,'fecha');
    $xstatus=filter_input(INPUT_POST,'estatus');
    $xhipodromo=filter_input(INPUT_POST,'hip');
    if (isset($_POST['tmz'])){$tmz=filter_input(INPUT_POST,'tmz');}else{$tmz='america/Lima';}
    
    $results=$betapi->apuestas_realizadas($token,$xfecha,$xhipodromo,$xstatus,$tmz);

    //if (!isset($results->error)){
        echo $results;
    //}else{
    //    echo '{"error":1}';
    //}   

}
   
if ($accion==='ver_ticket'){
    $betapi = new data_Connect("http",$url,$path);
    $token=$_SESSION['token'];
    $serial=filter_input(INPUT_POST,'serial');
    
    $results=$betapi->ver_ticket($token,$serial);
   
    echo $results;    
}

if ($accion==='resultados_dia'){
    $betapi = new data_Connect("http",$url,$path);
    $token=$_SESSION['token'];
    $fecha=filter_input(INPUT_POST,'fecha');
    $tp_usuario=$_SESSION['tp_user'];
    $results=$betapi->resultados_dia($token,$fecha,$tp_usuario);
   
    echo $results;    
}

if ($accion==='resultados_hipodromo2'){
    $betapi = new data_Connect("http",$url,$path);
    $token=$_SESSION['token'];
    $fecha=filter_input(INPUT_POST,'fecha');
    $id_pista=filter_input(INPUT_POST,'id_pista');
    $tp_usuario=$_SESSION['tp_user'];
    
    $results=$betapi->resultados_hipodromo2($token,$fecha,$id_pista,$tp_usuario);
   
    echo $results;    
}

if ($accion==='resultados_hipodromo'){
    $betapi = new data_Connect("http",$url,$path);
    $token=$_SESSION['token'];
    $fecha=filter_input(INPUT_POST,'fecha');
    $id_pista=filter_input(INPUT_POST,'id_pista');
    
    $results=$betapi->resultados_hipodromo($token,$fecha,$id_pista);
   
    echo $results;    
}

if ($accion==='resultados_detalle_carrera'){
    $betapi = new data_Connect("http",$url,$path);
    $token=$_SESSION['token'];
    $fecha=filter_input(INPUT_POST,'fecha');
    $id_pista=filter_input(INPUT_POST,'id_pista');
    $carrera=filter_input(INPUT_POST,'carrera');
            
    $results=$betapi->resultados_detalle_carrera($token,$fecha,$id_pista,$carrera);
   
    echo $results;    
}

if ($accion==='movimientos_web'){
    $betapi = new data_Connect("http",$url,$path);
    $token=$_SESSION['token'];
    $desde=filter_input(INPUT_POST,'desde');
    $hasta=filter_input(INPUT_POST,'hasta');
    $filtro=filter_input(INPUT_POST,'filtro');
            

    $results=$betapi->movimientos_web($token,$desde,$hasta,$filtro);
   
    echo $results;        
}

if ($accion==='lista_deporeti'){

    $betapi = new data_Connect("http",$url,$path);
    $token=$_SESSION['token'];
    $fecha1=filter_input(INPUT_POST,'fecha1');
    $fecha2=filter_input(INPUT_POST,'fecha2');
    $results=$betapi->cashierDepositoRetiro($fecha1,$fecha2,$token);
   
    echo $results;    
}

if ($accion==='numero_cuenta'){
    $betapi = new data_Connect("http",$url,$path);
    $token=$_SESSION['token'];
           

    $results=$betapi->numero_cuenta($token);
   
    echo $results;        
}

if ($accion==='solicita_retiro'){
    $betapi = new data_Connect("http",$url,$path);
    $token=$_SESSION['token'];
    $monto=filter_input(INPUT_POST,'monto');   
    
    $banco=filter_input(INPUT_POST,'banco');   
    $cta=filter_input(INPUT_POST,'cta');   
    $info=filter_input(INPUT_POST,'info');   

    $results=$betapi->solicita_retiro($token,$monto,$banco,$cta,$info);
   
    echo $results;    
}

if ($accion==='perfil_usuario'){
    $betapi = new data_Connect("http",$url,$path);
    $token=$_SESSION['token'];
    
    $results=$betapi->perfil_usuario($token);
   
    echo $results;    
}

if ($accion==='actualiza_datos_web'){
    $betapi = new data_Connect("http",$url,$path);
    $token=$_SESSION['token'];
    $tdocumento=filter_input(INPUT_POST,'tdocumento');
    $estado=filter_input(INPUT_POST,'estado');
    $direccion=filter_input(INPUT_POST,'direccion');
    $ndocumento=filter_input(INPUT_POST,'ndocumento');
    $ciudad=filter_input(INPUT_POST,'ciudad');
    $tmovil=filter_input(INPUT_POST,'tmovil');
    $email=filter_input(INPUT_POST,'email');
    $nombre=filter_input(INPUT_POST,'nombre');
    $nacimiento=filter_input(INPUT_POST,'nacimiento');
    
    $results=$betapi->actualiza_datos_web($token,$tdocumento,$estado,$direccion,$ndocumento,$ciudad,$tmovil,$email,$nombre);
   
    echo $results;        
}

if ($accion ==='pagos_disponibles_web'){
    $betapi = new data_Connect("http",$url,$path);
    $token=$_SESSION['token'];    
    $results=$betapi->pagos_disponibles_web($token);
    echo $results;        
}

if ($accion==='registro_pago_trans'){
    $betapi = new data_Connect("http",$url,$path);
    $token=$_SESSION['token'];
    $tbd=filter_input(INPUT_POST,'tbd');
    $tf=filter_input(INPUT_POST,'tf');
    $tr=filter_input(INPUT_POST,'tr');
    $tm=filter_input(INPUT_POST,'tm');
    $to=filter_input(INPUT_POST,'to');
    $octa=filter_input(INPUT_POST,'octa');
    
   
    if(isset($_FILES["file"])){
        $validextensions = array("jpeg", "jpg", "png");
        $temporary = explode(".", $_FILES["file"]["name"]);
        $file_extension = end($temporary);
        if ((($_FILES["file"]["type"] == "image/png") || ($_FILES["file"]["type"] == "image/jpg") || ($_FILES["file"]["type"] == "image/jpeg")) && ($_FILES["file"]["size"] < 5000000)//Approx. 100kb files can be uploaded.
                
        && in_array($file_extension, $validextensions)) {
            if ($_FILES["file"]["error"] > 0){
                echo "ERROR_IMAGEN";
                return;
            }else{
                $ext="jpg";
                if ($_FILES["file"]["type"] == "image/png") {$ext="png";}
                if ($_FILES["file"]["type"] == "image/jpg") {$ext="jpg";}
                if ($_FILES["file"]["type"] == "image/jpeg") {$ext="jpeg";}
                $ni=genera_key(10,"qwertyuioplkjhgfdsazxcvbnm1234567890QWERTYUIOPLKJHGFDSAZXCVBNM");
                $nimgaen=$ni.".".$ext;
                $sourcePath = $_FILES['file']['tmp_name']; // Storing source path of the file in a variable
                $targetPath = "../depositos/".$nimgaen; // Target path where file is to be stored
                move_uploaded_file($sourcePath,$targetPath) ; // Moving Uploaded file
            }
        }else{
            echo "ERROR_IMAGEN_TAM";
            return;
        }
    }else{
        #echo "ERROR_IMAGEN_FALTA";
        #return;
    }    
    
    $nimgaen="novi.png";
    $results=$betapi->registro_pago_trans($token,$tbd,$tf,$tr,$tm,$to,$octa,$nimgaen);
   
    echo $results;        
}

if ($accion =='Carreras_Dia'){
    $betapi = new data_Connect("http",$url,$path);
    $token=$_SESSION['token'];
    $id_pista=filter_input(INPUT_POST,'id_pista');
    
    
    $results=$betapi->Carreras_Dia($token,$id_pista);
   
    echo $results;            
}

if ($accion == 'busca_retirados_carreras'){
    $betapi = new data_Connect("http",$url,$path);
    $token=$_SESSION['token'];
    $id_crr=filter_input(INPUT_POST,'id_crr');
    $tp_usuario=$_SESSION['tp_user'];
    $results=$betapi->busca_retirados_carreras($token,$id_crr,$tp_usuario);
   
    echo $results;                
}

if ($accion==='sfp'){
    $betapi = new data_Connect("http",$url,$path);
    $token=$_SESSION['token'];
    $tipo=filter_input(INPUT_POST,'tipo');
    $monto=filter_input(INPUT_POST,'monto');
    
    $results=$betapi->pasarela_pgo($token,$tipo,$monto);
   
    echo $results;        
}

if ($accion==='busca_pizarra_hipica'){
    $betapi = new data_Connect("http",$url,$path);
    $token=$_SESSION['token'];
    $id_polla=filter_input(INPUT_POST,'idp');

    $results=$betapi->busca_pizarra_hipica($token,$id_polla);
   
    echo $results;            
}

if ($accion==='hipodromos_activos'){
    $betapi = new data_Connect("http",$url,$path);
    $token=$_SESSION['token'];
    $tp_usuario=$_SESSION['tp_user'];
    $results=$betapi->hipodromos_activos($token,$tp_usuario);
   
    echo $results;                
}


if ($accion==='resultados_detalle_carrera2'){
    $betapi = new data_Connect("http",$url,$path);
    $token=$_SESSION['token'];
    $fecha=filter_input(INPUT_POST,'fecha');
    $id_pista=filter_input(INPUT_POST,'id_pista');
    $carrera=filter_input(INPUT_POST,'carrera');
    $tp_usuario=$_SESSION['tp_user'];
    $results=$betapi->resultados_detalle_carrera2($token,$fecha,$id_pista,$carrera,$tp_usuario);
   
    echo $results;    
}

if ($accion==='apuestas_minimas'){
    $betapi = new data_Connect("http",$url,$path);
    $token=$_SESSION['token'];
    $tp_usuario=$_SESSION['tp_user'];        
    $results=$betapi->apuestas_minimas($token,$tp_usuario);
   
    echo $results;    
}

if ($accion==='ultima_jugada'){
    $betapi = new data_Connect("http",$url,$path);
    if (isset($_SESSION['token'])){$token=$_SESSION['token'];}else{return;}
    $token=$_SESSION['token'];
    $tp_usuario=$_SESSION['tp_user'];        
    $results=$betapi->ultima_jugada($token,$tp_usuario);
   
    echo $results;    
}

if ($accion==='cambio_psw'){
    $betapi = new data_Connect("http",$url,$path);
    $token=$_SESSION['token'];
    $act_psw=filter_input(INPUT_POST,'act_psw');
    $new_psw=filter_input(INPUT_POST,'new_psw');
    $rpt_psw=filter_input(INPUT_POST,'rpt_psw');
    
    if ($new_psw !==$rpt_psw){
        echo '{"estatus":"dpasw"}';
        return;
    }
    $results=$betapi->cambio_psw($token,$act_psw,$new_psw,$rpt_psw);
   
    echo $results;  
    return;
}


/**************** RETAIL ********/

if ($accion==='cdc'){
    $betapi = new data_Connect("http",$url,$path);
    
    $fechad=filter_input(INPUT_POST,'fechad');
    $fechah=filter_input(INPUT_POST,'fechah');
    $token=$_SESSION['token'];
    
    $results=$betapi->cdc($token,$fechad,$fechah);
   
    echo $results;  
    return;
}

if ($accion==='cdc_xl'){
    $betapi = new data_Connect("http",$url,$path);
    
    $fechad=filter_input(INPUT_POST,'fechad');
    $fechah=filter_input(INPUT_POST,'fechah');
    $opcion=filter_input(INPUT_POST,'opcion');
    $token=$_SESSION['token'];
    
    $results=$betapi->cdc_xl($token,$fechad,$fechah,$opcion);
  
    echo $results;  
    return;
}

if ($accion==='apretaill'){
    $betapi = new data_Connect("http",$url,$path);
    $token=$_SESSION['token'];
    $estatus=filter_input(INPUT_POST,'estatus');
    $hip=filter_input(INPUT_POST,'hip');
    $fecha=filter_input(INPUT_POST,'fecha');
    
    $results=$betapi->apretaill($token,$estatus,$hip,$fecha);
   
    echo $results;  
    return;
}

if ($accion==='ver_ticket_r'){
    $betapi = new data_Connect("http",$url,$path);
    $token=$_SESSION['token'];
    $serial=filter_input(INPUT_POST,'serial');
    
    $results=$betapi->ver_ticket_r($token,$serial);
   
    echo $results;    
}

if ($accion==='auto'){
    $betapi = new data_Connect("http",$url,$path);
    $token=$_SESSION['token'];
    $results=$betapi->auto($token);
    echo $results;        
}

if ($accion==='tckpagar'){
    #esta funcion paga y procesa el pago o devolucion del tck
    $betapi = new data_Connect("http",$url,$path);
    $token=$_SESSION['token'];
    $serial=filter_input(INPUT_POST,'q');
    $w=filter_input(INPUT_POST,'w');
    $opc=filter_input(INPUT_POST,'opc');
    
    $results=$betapi->tckpagar($token,$serial,$w,$opc);
   
    echo $results;    
}

if ($accion==='elimina_auto'){
    #esta funcion paga y procesa el pago o devolucion del tck
    $betapi = new data_Connect("http",$url,$path);
    $token=$_SESSION['token'];
    
    $results=$betapi->elimina_auto($token);
   
    echo $results;    
}

if ($accion==='elimina_auto_id'){
    #esta funcion paga y procesa el pago o devolucion del tck
    $betapi = new data_Connect("http",$url,$path);
    $token=$_SESSION['token'];
    $id_r = filter_input(INPUT_POST,'idr');
    $results=$betapi->elimina_auto_id($token,$id_r);
   
    echo $results;    
}

if ($accion==='r_registro'){
    
    #esta funcion paga y procesa el pago o devolucion del tck
    $betapi = new data_Connect("http",$url,$path);
    $token=$_SESSION['token'];
    
    $inputUsuario = filter_input(INPUT_POST,'inputUsuario');
    $inputNombre = filter_input(INPUT_POST,'inputNombre');
    $inputTelefono = filter_input(INPUT_POST,'inputTelefono');
    $inputCorreo = filter_input(INPUT_POST,'inputCorreo');
    $inputPassword = filter_input(INPUT_POST,'inputPassword');
    $inputNDocumento = filter_input(INPUT_POST,'inputNDocumento');
    $inputTDocumento = filter_input(INPUT_POST,'inputTDocumento');
    $inputDireccion = filter_input(INPUT_POST,'inputDireccion');
    $inputFecha = filter_input(INPUT_POST,'inputFecha');
     $org ="";
    if (isset($_POST['org'])){
        $org = filter_input(INPUT_POST,'org'); 
    }
    
    
    $results=$betapi->r_registro($token,$inputUsuario,$inputNombre,$inputTelefono,$inputCorreo,$inputPassword,$inputNDocumento,$inputTDocumento,$inputDireccion,$inputFecha,$org);
   
    echo $results;    
}

if ($accion==='r_listas_usuario'){
    #esta funcion paga y procesa el pago o devolucion del tck
    $betapi = new data_Connect("http",$url,$path);
    $token=$_SESSION['token'];
    
    $results=$betapi->r_listas_usuario($token);
   
    echo $results;    
}

if ($accion==='transferir_r'){
    #esta funcion paga y procesa el pago o devolucion del tck
    $betapi = new data_Connect("http",$url,$path);
    $token=$_SESSION['token'];
    $idu = filter_input(INPUT_POST,'idu');
    $mto = filter_input(INPUT_POST,'mto');    
    $results=$betapi->transferir_r($token,$idu,$mto);
   
    echo $results;    
}

if ($accion==='retira_r'){
    #esta funcion paga y procesa el pago o devolucion del tck
    $betapi = new data_Connect("http",$url,$path);
    $token=$_SESSION['token'];
    $idu = filter_input(INPUT_POST,'idu');
    $mto = filter_input(INPUT_POST,'mto');    
    $results=$betapi->retira_r($token,$idu,$mto);
   
    echo $results;    
}

if ($accion==='r_new_password'){
    #esta funcion paga y procesa el pago o devolucion del tck
    $betapi = new data_Connect("http",$url,$path);
    $token=$_SESSION['token'];
    $idu = filter_input(INPUT_POST,'idu');
    $psw = filter_input(INPUT_POST,'psw');    
    $results=$betapi->r_new_password($token,$idu,$psw);
   
    echo $results;    
}
if ($accion==='bloquea_desbloquea_user'){
    #esta funcion paga y procesa el pago o devolucion del tck
    $betapi = new data_Connect("http",$url,$path);
    $token=$_SESSION['token'];
    $idu = filter_input(INPUT_POST,'idu');
    $results=$betapi->r_bloquea_desbloquea_user($token,$idu);
   
    echo $results;    
}

if ($accion==='consulta_usr'){
    $betapi = new data_Connect("http",$url,$path);
    $token=$_SESSION['token'];
    $idu = filter_input(INPUT_POST,'idu');
    $results=$betapi->consulta_usr($token,$idu);
   
    echo $results;     
}

if ($accion==='generar_prepago'){
    $betapi = new data_Connect("http",$url,$path);
    $token=$_SESSION['token'];
    $mto = filter_input(INPUT_POST,'mto');    
    $tlf = filter_input(INPUT_POST,'tlf');
    $results=$betapi->generar_prepago($token,$mto,$tlf);
   
    echo $results;         
}

if ($accion==='r_retiro_consulta'){
    $betapi = new data_Connect("http",$url,$path);
    $token=$_SESSION['token'];
            
    $results=$betapi->r_retiro_consulta($token);
   
    echo $results;    
}

if ($accion==='r_retiro_'){
    $betapi = new data_Connect("http",$url,$path);
    $token=$_SESSION['token'];
    $mto = filter_input(INPUT_POST,'mto');        
    $results=$betapi->r_retiro_($token,$mto);
   
    echo $results;    
}

if ($accion==='valida_clave_ret'){
    $betapi = new data_Connect("http",$url,$path);
    $token=$_SESSION['token'];
    $clv = filter_input(INPUT_POST,'clv');        
    $results=$betapi->valida_clave_ret($token,$clv);
   
    echo $results;    
}

if ($accion==='procesar_retiro_ret'){
    $betapi = new data_Connect("http",$url,$path);
    $token=$_SESSION['token'];
    $idr = filter_input(INPUT_POST,'idr');        
    $results=$betapi->procesar_retiro_ret($token,$idr);
   
    echo $results;    
}

if ($accion==='recargar_rw_tarjeta'){
    $betapi = new data_Connect("http",$url,$path);
    $token=$_SESSION['token'];
    $cod = filter_input(INPUT_POST,'cod');        
    $results=$betapi->recargar_rw_tarjeta($token,$cod);
   
    echo $results;    
}

if ($accion==='abre_casino'){
    $betapi = new data_Connect("http",$url,$path);
    $token=$_SESSION['token'];
    $tp_usuario ="W";
    $t_juego=filter_input(INPUT_POST,'tjuego');
    $results=$betapi->login_casino($token,$tp_usuario,$t_juego);
   
    
    echo $results;  
    return;
}

if ($accion==='consulta_vta_retail_web'){
    $betapi = new data_Connect("http",$url,$path);
    $token=$_SESSION['token'];
    $tp_usuario ="T";
    $fecha1=filter_input(INPUT_POST,'fecha1');
    $fecha2=filter_input(INPUT_POST,'fecha2');
    $results=$betapi->consulta_vta_retail_web($token,$tp_usuario,$fecha1,$fecha2);
   
    
    echo $results;  
    return;
}

if ($accion==='consulta_remoto'){
    $betapi = new data_Connect("http",$url,$path);
    $token=$_SESSION['token'];

    $results=$betapi->consulta_remoto($token);
   
    
    echo $results;  
    return;
}

/* MAQUINAS RULETAS SLOT */

if ($accion==='acreditar_mq'){
    #esta funcion paga y procesa el pago o devolucion del tck
    $betapi = new data_Connect("http",$url,$path);
    $token=$_SESSION['token'];
    $idm = filter_input(INPUT_POST,'idm');
    $mto = filter_input(INPUT_POST,'mto');    
    $puesto = filter_input(INPUT_POST,'puesto');    
    $results=$betapi->acreditar_mq($token,$idm,$mto,$puesto);
   
    echo $results;  
    return;
    
}

if ($accion==='lista_retiros_mq'){
    #esta funcion paga y procesa el pago o devolucion del tck
    $betapi = new data_Connect("http",$url,$path);
    $token=$_SESSION['token'];
    $id=filter_input(INPUT_POST,'idm'); 
    $fecha=filter_input(INPUT_POST,'fecha');
    $estatus=filter_input(INPUT_POST,'estatus');
    $tipo=filter_input(INPUT_POST,'tipo');
    $results=$betapi->lista_retiros_mq($token,$id,$fecha,$estatus,$tipo);
   
    echo $results;  
    return;
    
}

if ($accion==='confirma_retiro_mq'){
    #esta funcion paga y procesa el pago o devolucion del tck
    $betapi = new data_Connect("http",$url,$path);
    $token=$_SESSION['token'];
    $id_proceso=filter_input(INPUT_POST,'id_proceso');
    $results=$betapi->confirma_retiro_mq($token,$id_proceso);
   
    echo $results;  
    return;
    
}

if ($accion==='contadores_ruleta'){
    #esta funcion paga y procesa el pago o devolucion del tck
    $betapi = new data_Connect("http",$url,$path);
    $token=$_SESSION['token'];
    $dfecha=filter_input(INPUT_POST,'dfecha');
    $hfecha=filter_input(INPUT_POST,'hfecha');
    $results=$betapi->contadores_ruleta($token,$dfecha,$hfecha);
   
    echo $results;  
    return;
    
}

function genera_key($longitud,$pattern){
            
        $key = '';
        $max = strlen($pattern)-1;
        for($i=0;$i < $longitud;$i++) $key .= $pattern{mt_rand(0,$max)};
        return $key;
}
?>

