<?php
require 'modelo/class_datos.php';

$url="lottohipico.com";
$path="n19/opt/betapi/bet_api.php";
//$url="127.0.0.1:8080";
//$path="n19c/opt/betapi/bet_api.php";

$betapi = new data_Connect("http",$url,$path);
$Atoken="43a3fb5a48fee2b0b48aede27c02b16a"; #es el token para consulta generales que no requiere el id del usuario

    if (filter_input(INPUT_POST,'accion')==='registro'){
        $vusuario=filter_input(INPUT_POST,'inputUsuario');
        $vnombre=filter_input(INPUT_POST,'inputNombre');
        $vfechan=filter_input(INPUT_POST,'inputFecha');
        $vcorreo=strtolower(filter_input(INPUT_POST,'inputCorreo'));
        $vpass=filter_input(INPUT_POST,'inputPassword');
        $vtelefono=filter_input(INPUT_POST,'inputTelefono');
        $vMoneda=filter_input(INPUT_POST,'inputMoneda');

        
        
        if($vMoneda==9){$pais=51;}
        if($vMoneda==7){$pais=56;}
        if($vMoneda==8){$pais=57;}
        if($vMoneda==1){$pais=58;}
        if($vMoneda==10){$pais=593;}
        if($vMoneda==3){$pais=1;}
        if($vMoneda==14){$pais=507;}
        if($vMoneda==15){$pais=51;}

        
	if( empty($vnombre)  or empty($vfechan) or empty($vcorreo)
                or empty($vpass)  or empty($vtelefono) or empty($vMoneda)){
			echo "Error";
                        return;
	}else{
                if (trim($vpass)==''){
                    echo "2"; //el password no puede estar en blanco
                    return;
                }

                if (strlen(trim($vpass)) <=4){
                    echo "3"; //debe tener al menos 5 caracteres
                    return;
                }
                
                $results=$betapi->registro($vusuario,$vnombre,$vfechan,$vcorreo,$vpass,$vtelefono,$vMoneda);
                
                echo $results;
           
        }
    }