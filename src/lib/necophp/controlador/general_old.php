<?php

session_start();

if(!isset($_SESSION['id'])){
    session_destroy();
    echo "<script>window.parent.location='index.php'</script>";
}

require 'modelo/class_datos.php';

$url="lottohipico.com";
$path="n19/opt/betapi/bet_api.php";

//$url="127.0.0.1:8080";
//$path="n19c/opt/betapi/bet_api.php";

if ($accion==='ini'){
    $serv_li = "admin.universalrace.net:4021";
    //$serv_li = "144.217.208.118:4030";
    //$serv_li = "127.0.0.1:4030";
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
    . "\"simbolo\":\"$_SESSION[simbolo]\"
    }";
    
    return;
   
}



if ($accion==='apr'){

    $betapi = new data_Connect("http",$url,$path);
    $token=$_SESSION['token'];
    $xfecha=filter_input(INPUT_POST,'fecha');
    $xstatus=filter_input(INPUT_POST,'estatus');
    $xhipodromo=filter_input(INPUT_POST,'hip');
    
    $results=$betapi->apuestas_realizadas($token,$xfecha,$xhipodromo,$xstatus);

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
    
    $results=$betapi->resultados_dia($token,$fecha);
   
    echo $results;    
}

if ($accion==='resultados_hipodromo2'){
    $betapi = new data_Connect("http",$url,$path);
    $token=$_SESSION['token'];
    $fecha=filter_input(INPUT_POST,'fecha');
    $id_pista=filter_input(INPUT_POST,'id_pista');
    
    $results=$betapi->resultados_hipodromo2($token,$fecha,$id_pista);
   
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
    $results=$betapi->solicita_retiro($token,$monto);
   
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

    
    $results=$betapi->registro_pago_trans($token,$tbd,$tf,$tr,$tm,$to,$octa);
   
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
    
    $results=$betapi->busca_retirados_carreras($token,$id_crr);
   
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
    $results=$betapi->hipodromos_activos($token);
   
    echo $results;                
}


if ($accion==='resultados_detalle_carrera2'){
    $betapi = new data_Connect("http",$url,$path);
    $token=$_SESSION['token'];
    $fecha=filter_input(INPUT_POST,'fecha');
    $id_pista=filter_input(INPUT_POST,'id_pista');
    $carrera=filter_input(INPUT_POST,'carrera');
            
    $results=$betapi->resultados_detalle_carrera2($token,$fecha,$id_pista,$carrera);
   
    echo $results;    
}

if ($accion==='apuestas_minimas'){
    $betapi = new data_Connect("http",$url,$path);
    $token=$_SESSION['token'];
            
    $results=$betapi->apuestas_minimas($token);
   
    echo $results;    
}
?>

