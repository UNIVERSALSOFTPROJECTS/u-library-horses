<?php

require 'modelo/class_datos.php';

#$url="lottohipico.com";
$url="51.222.218.97";
$path="n19/opt/betapi/bet_api.php";

$betapi = new data_Connect("http",$url,$path);
$Atoken="43a3fb5a48fee2b0b48aede27c02b16a"; #es el token para consulta generales que no requiere el id del usuario

$usr=$_POST['xname'];
$pas=$_POST['xpass'];
$xyz=$_POST['xyz'];

$ip = isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];

$results=$betapi->login($usr,$pas,$ip);

//print_r($results);

if (!isset($results->error)){
    
    session_start();
    
    $_SESSION['id']=$results[0]->id;
    $_SESSION['usuario']=$results[0]->usuario;
    $_SESSION['id_ca']=$results[0]->id_ca;
    $_SESSION['id_banca']=$results[0]->id_banca;
    $_SESSION['server']=$results[0]->server;
    $_SESSION['arroba']=$results[0]->arroba;
    $_SESSION['tiempo'] = time();
    $_SESSION['nivel']=$results[0]->nivel;
    $_SESSION['ap_min_cab']=$results[0]->ap_min_cab;
    $_SESSION['ap_max_cab']=$results[0]->ap_max_cab;
    $_SESSION['max_tck']=$results[0]->maximo_vta_cab_tck;
    $_SESSION['per_video']=$results[0]->video;
    $_SESSION['per_teclacado']= 'f'; #$a['key_virtual']; 
    $_SESSION['moneda']=$results[0]->moneda; 
    $_SESSION['fondo']='wfondo.png';
    $_SESSION['tp_user']='W';
    $_SESSION['correo']=$results[0]->correo;
    $_SESSION['nombre']=$results[0]->nombre;
    $_SESSION['simbolo']=$results[0]->simbolo;
    $_SESSION['saldo']=$results[0]->balance;
    $_SESSION['apostado']=0;
    $_SESSION['token']=$results[0]->token;
    $_SESSION['atoken']=$Atoken;
    $_SESSION['cod_pais']=$results[0]->cod_pais;
    $_SESSION['url']="127.0.0.1:8080"; #es la url del cliente si no esta registrado no accede a la api
    $_SESSION['path']="n19/opt/betapi/bet_api.php";
    $_SESSION['css']="HH"; #$results[0]->css;
    echo $x= 'si';    
    
}else{
    echo '{"error":1}';
}
