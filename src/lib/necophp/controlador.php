<?php

if (isset($_POST['accion'])){
    
    $accion=$_POST['accion'];
    
    if ($accion === 'login' or $accion === 'loginr'){
        if ($accion === 'login'){
            require "controlador/login_w.php";
        }
        if ($accion === 'loginr'){
            
            require "controlador/login_t.php";
        }        
    }else{
        
        require "controlador/general.php";
        /*
        if ($accion === 'ini'){
            require "controlador/general.php";
        }    
        if ($accion === 'apr'){
            require "controlador/general.php";
        }  
        if ($accion === 'ver_ticket'){
            require "controlador/general.php";
        } 
        if ($accion ==='resultados_dia'){
            require "controlador/general.php";
        }
        if ($accion ==='resultados_hipodromo'){
            require "controlador/general.php";
        } 
        if ($accion ==='resultados_detalle_carrera'){
            require "controlador/general.php";
        } 
        if ($accion ==='movimientos_web'){
            require "controlador/general.php";
        }        
        */
        
    }
}

?>
