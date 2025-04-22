<?php

class data_Connect {

	private $url;
 
	public function __construct($protocol,$server,$patch) {
		$this->url = $protocol.'://'.$server.'/'.$patch;
        }
        
        public function respuesta($postdata){
                
                $opts = array('http' =>
                    array(
                        'method'  => 'POST',
                        'header'  => 'Content-Type: application/x-www-form-urlencoded',
                        'content' => $postdata
                    )
                ); 

	     if ($this->url == "http://127.0.0.1:8080/n19/opt/betapi/bet_api.php"){
	    	return;
	     } 
           
                $context  = stream_context_create($opts);
                $contents = file_get_contents($this->url, false, $context);
                #print_r($contents);
                $contents = utf8_encode($contents);
                //$results = json_decode($contents);                
                #print_r($results);
                return $contents;
        }

        public function retirados($token,$idt,$cr){
                $postdata = http_build_query(
                    array(
                        'accion' => 'retirados',
                        'tk' => $token,
                        'idt' => $idt,
                        'cr' => $cr
                    )
                );
                
                echo $this->respuesta($postdata);
                return;
                //return json_decode($this->respuesta($postdata));               
        }        
        
        public function chpk2($token,$idt,$tr,$cr,$id_crr){
                $postdata = http_build_query(
                    array(
                        'accion' => 'chpk2',
                        'tk' => $token,
                        'idt' => $idt,
                        'tr' => $tr,
                        'cr' => $cr,
                        'id_crr' => $id_crr
                    )
                );
                
                echo $this->respuesta($postdata);
                return;
                //return json_decode($this->respuesta($postdata));               
        }
        public function API_Valida_TK_RETAIL($tk){
                $postdata = http_build_query(
                    array(
                        'accion' => 'API_Valida_TK_RETAIL',
                        'tk' => $tk
                    )
                );
                #echo $this->respuesta($postdata);
                return json_decode($this->respuesta($postdata));            
        } 
        
        public function cashierDepositoRetiro($fecha1,$fecha2,$token) {
            $postdata = http_build_query(
                array(
                    'accion' => 'lista_deporeti',
                    'fecha1' => $fecha1,
                    'fecha2' => $fecha2,
                    'token' => $token
                )
            );
            return $this->respuesta($postdata);   
        }
    
	public function monedas($token)
	{
                $postdata = http_build_query(
                    array(
                        'accion' => 'monedas',
                        'token' => $token
                    )
                );
                return json_decode($this->respuesta($postdata));
	}

	public function video($token)
	{
                $postdata = http_build_query(
                    array(
                        'accion' => 'video',
                        'token' => $token
                    )
                );
                return json_decode($this->respuesta($postdata));
	}  
<<<<<<< HEAD
	public function rvideo($token)
=======
	public function rvideo($token) //LISTO
>>>>>>> e279d50609a197b9d9b45fc3d162851700515402
	{
                $postdata = http_build_query(
                    array(
                        'accion' => 'rvideo',
                        'token' => $token
                    )
                );
                return json_decode($this->respuesta($postdata));
	}         
        
	public function login($usuario, $pass,$ip)
	{
                $postdata = http_build_query(
                    array(
                        'accion' => 'login',
                        'usr' => $usuario,
                        'pass' => $pass,
                        'xyz' => '9999',
                        'ip' => $ip
                    )
                );
                return json_decode($this->respuesta($postdata));
	}
	
 	public function registro($vusuario,$vnombre,$vfechan,$vcorreo,$vpass,$vtelefono,$vMoneda)
	{
                $postdata = http_build_query(
                    array(
                        'accion' => 'registro',
                        'inputUsuario' => $vusuario,
                        'inputNombre' => $vnombre,
                        'inputFecha' => $vfechan,
                        'inputCorreo' => $vcorreo,
                        'inputPassword' => $vpass,
                        'inputTelefono' => $vtelefono,
                        'inputMoneda' => $vMoneda,
                        'token' => ''
                    )
                );
                return $this->respuesta($postdata);
	}       
        
        public function valida_registro($Atoken,$token){
                $postdata = http_build_query(
                    array(
                        'accion' => 'valida_registro',
                        'Atoken' => $Atoken,
                        'token' => $token
                    )
                );
                return $this->respuesta($postdata);            
        }
        
	public function apuestas_realizadas($token,$xfecha,$xhipodromo,$xstatus,$tmz)
	{
                $postdata = http_build_query(
                    array(
                        'accion' => 'apr',
                        'token' => $token,
                        'fecha' => $xfecha,
                        'hipodromo' => $xhipodromo,
                        'estatus' => $xstatus,
			'tmz'=>$tmz
                    )
                );
                 
               return $this->respuesta($postdata);
	}        
        
<<<<<<< HEAD
	public function lista_hipodromos($Atoken)
=======
	public function lista_hipodromos($Atoken) //LISTO
>>>>>>> e279d50609a197b9d9b45fc3d162851700515402
	{        
            $postdata = http_build_query(
                array(
                    'accion' => 'lista_hipodromos',
                    'token' => $Atoken
                )
            );

           return json_decode($this->respuesta($postdata));            
            
        }
        
	public function ver_ticket($token,$serial)
	{        
            $postdata = http_build_query(
                array(
                    'accion' => 'ver_ticket',
                    'token' => $token,
                    'serial'=> $serial
                )
            );

           return $this->respuesta($postdata);            
            
        }
<<<<<<< HEAD
	public function resultados_dia($token,$fecha,$tp_usuario)
=======
	public function resultados_dia($token,$fecha,$tp_usuario) //LISTO
>>>>>>> e279d50609a197b9d9b45fc3d162851700515402
	{        
            $postdata = http_build_query(
                array(
                    'accion' => 'resultados_dia',
                    'token' => $token,
                    'fecha'=> $fecha,
                    'tp_usuario'=> $tp_usuario
                )
            );
           return $this->respuesta($postdata);            
        }        

	public function resultados_hipodromo($token,$fecha,$id_pista)
	{        
            $postdata = http_build_query(
                array(
                    'accion' => 'resultados_hipodromo',
                    'token' => $token,
                    'fecha'=> $fecha,
                    'id_pista'=> $id_pista
                )
            );
           return $this->respuesta($postdata);            
        }        
        
<<<<<<< HEAD
	public function resultados_hipodromo2($token,$fecha,$id_pista,$tp_usuario)
=======
	public function resultados_hipodromo2($token,$fecha,$id_pista,$tp_usuario) //LISTO
>>>>>>> e279d50609a197b9d9b45fc3d162851700515402
	{        
            $postdata = http_build_query(
                array(
                    'accion' => 'resultados_hipodromo2',
                    'token' => $token,
                    'fecha'=> $fecha,
                    'id_pista'=> $id_pista,
                    'tp_usuario'=> $tp_usuario
                )
            );
           return $this->respuesta($postdata);            
        }
        
        public function resultados_detalle_carrera($token,$fecha,$id_pista,$carrera){
            $postdata = http_build_query(
                array(
                    'accion' => 'resultados_detalle_carrera',
                    'token' => $token,
                    'fecha'=> $fecha,
                    'id_pista'=> $id_pista,
                    'carrera'=> $carrera
                )
            );
           return $this->respuesta($postdata);            
        }
        
        public function movimientos_web($token,$desde,$hasta,$filtro){
            $postdata = http_build_query(
                array(
                    'accion' => 'movimientos_web',
                    'token' => $token,
                    'desde'=> $desde,
                    'hasta'=> $hasta,
                    'filtro'=> $filtro
                )
            );
           return $this->respuesta($postdata);                        
        }
        
        public function numero_cuenta($token){
            $postdata = http_build_query(
                array(
                    'accion' => 'numero_cuenta',
                    'token' => $token
                )
            );
           return $this->respuesta($postdata);                        
        }        
        
        public function solicita_retiro($token,$monto,$banco,$cta,$info){
            $postdata = http_build_query(
                array(
                    'accion' => 'solicita_retiro',
                    'token' => $token,
                    'monto' => $monto,
                    'banco' => $banco,
                    'cta' => $cta,
                    'info' => $info
                )
            );
           return $this->respuesta($postdata);                                    
        }
<<<<<<< HEAD
        public function ultima_jugada($token,$tp_usuario){
=======
        public function ultima_jugada($token,$tp_usuario){ //LISTO
>>>>>>> e279d50609a197b9d9b45fc3d162851700515402
            $postdata = http_build_query(
                array(
                    'accion' => 'ultima_jugada',
                    'token' => $token,
                    'tp_usuario' => $tp_usuario
                )
            );
           return $this->respuesta($postdata);                                    
        }
        
        public function perfil_usuario($token){
            $postdata = http_build_query(
                array(
                    'accion' => 'perfil_usuario',
                    'token' => $token
                )
            );
           return $this->respuesta($postdata);                                    
        }
        
        public function actualiza_datos_web($token,$tdocumento,$estado,$direccion,$ndocumento,$ciudad,$tmovil,$email,$nombre){
            $postdata = http_build_query(
                array(
                    'accion' => 'actualiza_datos_web',
                    'token' => $token,
                    'tdocumento' => $tdocumento,
                    'estado' => $estado,
                    'direccion' => $direccion,
                    'ndocumento' => $ndocumento,
                    'ciudad' => $ciudad,
                    'tmovil' => $tmovil,
                    'email' => $email,
                    'nombre' => $nombre
                    
                )
            );
            
           return $this->respuesta($postdata);            
        }
        
        public function pagos_disponibles_web($token){
            $postdata = http_build_query(
                array(
                    'accion' => 'pagos_disponibles_web',
                    'token' => $token
                )            
            );
            return $this->respuesta($postdata);
        }
        public function registro_pago_trans($token,$tbd,$tf,$tr,$tm,$to,$octa,$img){
            $postdata = http_build_query(
                array(
                    'accion' => 'registro_pago_trans',
                    'token' => $token,
                    'tbd' => $tbd,
                    'tf' => $tf,
                    'tr' => $tr,
                    'tm' => $tm,
                    'to' => $to,
                    'octa' => $octa,
                    'nimgaen' => $img
                )
            );
            
           return $this->respuesta($postdata);            
        }
        
        public function pasarela_pgo($token,$tipo,$monto){
            $postdata = http_build_query(
                array(
                    'accion' => 'pasarela_pgo',
                    'token' => $token,
                    'tipo' => $tipo,
                    'monto' => $monto
                )
            );            
            return $this->respuesta($postdata);            
        }        
        public function Carreras_Dia($token,$id_pista){
            $postdata = http_build_query(
                array(
                    'accion' => 'Carreras_Dia',
                    'token' => $token,
                    'id_pista' => $id_pista
                )
            );            
            return $this->respuesta($postdata);            
        }    
        
<<<<<<< HEAD
        public function busca_retirados_carreras($token,$id_crr,$tp_usuario){
=======
        public function busca_retirados_carreras($token,$id_crr,$tp_usuario){ //LISTO
>>>>>>> e279d50609a197b9d9b45fc3d162851700515402
            $postdata = http_build_query(
                array(
                    'accion' => 'busca_retirados_carreras',
                    'token' => $token,
                    'id_crr' => $id_crr,
                    'tp_usuario' => $tp_usuario
                )
            );            
            return $this->respuesta($postdata);                        
        }

        public function busca_pizarra_hipica($token,$id_polla){
            $postdata = http_build_query(
                array(
                    'accion' => 'busca_pizarra_hipica',
                    'token' => $token,
                    'id_polla' => $id_polla
                )
            );            
            return $this->respuesta($postdata);                        
        }
        
<<<<<<< HEAD
        public function hipodromos_activos($token,$tp_usuario){
=======
        public function hipodromos_activos($token,$tp_usuario){ //LISTO
>>>>>>> e279d50609a197b9d9b45fc3d162851700515402
            $postdata = http_build_query(
                array(
                    'accion' => 'hipodromos_activos',
                    'token' => $token,
                    'tp_usuario' => $tp_usuario
                )
            );            
            return $this->respuesta($postdata);
        }
        
<<<<<<< HEAD
        public function resultados_detalle_carrera2($token,$fecha,$id_pista,$carrera,$tp_usuario){
            $postdata = http_build_query(
=======
        public function resultados_detalle_carrera2($token,$fecha,$id_pista,$carrera,$tp_usuario){ 
            $postdata = http_build_query( //LISTO
>>>>>>> e279d50609a197b9d9b45fc3d162851700515402
                array(
                    'accion' => 'resultados_detalle_carrera2',
                    'token' => $token,
                    'fecha'=> $fecha,
                    'id_pista'=> $id_pista,
                    'carrera'=> $carrera,
                    'tp_usuario' => $tp_usuario
                )
            );
           return $this->respuesta($postdata);            
        }

<<<<<<< HEAD
        public function apuestas_minimas($token,$tp_usuario){
=======
        public function apuestas_minimas($token,$tp_usuario){ //LISTO
>>>>>>> e279d50609a197b9d9b45fc3d162851700515402
            $postdata = http_build_query(
                array(
                    'accion' => 'apuestas_minimas',
                    'token' => $token,
                    'tp_usuario' => $tp_usuario
                )
            );            
            return $this->respuesta($postdata);
        } 

        public function cambio_psw($token,$act_psw,$new_psw,$rpt_psw){
            $postdata = http_build_query(
                array(
                    'accion' => 'cambio_psw',
                    'token' => $token,
                    'act_psw'=> $act_psw,
                    'new_psw'=> $new_psw,
                    'rpt_psw'=> $rpt_psw
                )
            );
           return $this->respuesta($postdata);            
        }        
/************************ RETAIL ******************************/        
<<<<<<< HEAD
	public function loginr($usuario, $pass)
=======
	public function loginr($usuario, $pass) //LISTO
>>>>>>> e279d50609a197b9d9b45fc3d162851700515402
	{
                $postdata = http_build_query(
                    array(
                        'accion' => 'loginr',
                        'usr' => $usuario,
                        'pass' => $pass,
                        'xyz' => '9999'
                    )
                );
                return json_decode($this->respuesta($postdata));
	}
        
	public function cdc($token,$fechad, $fechah)
	{
                $postdata = http_build_query(
                    array(
                        'accion' => 'cdc',
                        'fechad' => $fechad,
                        'fechah' => $fechah,
                        'token' => $token
                    )
                );
                #return json_decode($this->respuesta($postdata));
                return $this->respuesta($postdata);   
                
	}

	public function cdc_xl($token,$fechad, $fechah,$opcion)
	{
                $postdata = http_build_query(
                    array(
                        'accion' => 'cdc_xl',
                        'fechad' => $fechad,
                        'fechah' => $fechah,
                        'token' => $token,
			'opcion' => $opcion
                    )
                );
                #return json_decode($this->respuesta($postdata));
                return $this->respuesta($postdata);   
                
	}        

	public function cdc_xp($token,$fechad, $fechah,$buscar)
        {
                $postdata = http_build_query(
                    array(
                        'accion' => 'cdc_xp',
                        'fechad' => $fechad,
                        'fechah' => $fechah,
                        'token' => $token,
                        'buscar' => $buscar
                    )
                );
                #return json_decode($this->respuesta($postdata));
                return $this->respuesta($postdata);   

        }

        
	public function auto($token)
	{
                $postdata = http_build_query(
                    array(
                        'accion' => 'auto',
                        'token' => $token
                    )
                );
                #return json_decode($this->respuesta($postdata));
                return $this->respuesta($postdata);   
                
	}
        
 	public function apretaill($token,$estatus,$hip,$fecha)
	{
                $postdata = http_build_query(
                    array(
                        'accion' => 'apretaill',
                        'token' => $token,
                        'estatus' => $estatus,
                        'hip' => $hip,
                        'fecha' => $fecha
                    )
                );
                #return json_decode($this->respuesta($postdata));
                return $this->respuesta($postdata);   
                
	}       
	public function ver_ticket_r($token,$serial)
	{        
            $postdata = http_build_query(
                array(
                    'accion' => 'ver_ticket_r',
                    'token' => $token,
                    'serial'=> $serial
                )
            );

           return $this->respuesta($postdata);            
            
        }   
        
	public function tckpagar($token,$serial,$w,$opc)
	{        
            $postdata = http_build_query(
                array(
                    'accion' => 'tckpagar',
                    'token' => $token,
                    'serial'=> $serial,
                    'w'=> $w,
                    'opc'=> $opc
                )
            );

           echo $this->respuesta($postdata);
           #return json_decode($this->respuesta($postdata));            
            
        }
        
	public function elimina_auto($token)
	{        
            $postdata = http_build_query(
                array(
                    'accion' => 'elimina_auto',
                    'token' => $token
                )
            );

           echo $this->respuesta($postdata);
           #return json_decode($this->respuesta($postdata));            
            
        }        

	public function elimina_auto_id($token,$id_r)
	{        
            $postdata = http_build_query(
                array(
                    'accion' => 'elimina_auto_id',
                    'token' => $token,
                    'id_r' => $id_r
                )
            );

           echo $this->respuesta($postdata);
           #return json_decode($this->respuesta($postdata));            
            
        }         

	public function r_registro($token,$inputUsuario,$inputNombre,$inputTelefono,$inputCorreo,$inputPassword,$inputNDocumento,$inputTDocumento,$inputDireccion,$inputFecha,$org)
	{  
            
            $postdata = http_build_query(
                array(
                    'accion' => 'r_registro',
                    'token' => $token,
                    'inputUsuario' => $inputUsuario,
                    'inputNombre' => $inputNombre,
                    'inputTelefono' => $inputTelefono,
                    'inputCorreo' => $inputCorreo,
                    'inputPassword' => $inputPassword,
                    'inputNDocumento' => $inputNDocumento,
                    'inputTDocumento' => $inputTDocumento,
                    'inputDireccion' => $inputDireccion,
                    'inputFecha' => $inputFecha,
                    'org'=>$org
                )
            );
            
           echo $this->respuesta($postdata);
           #return json_decode($this->respuesta($postdata));            
            
        }
        
<<<<<<< HEAD
	public function r_listas_usuario($token)
=======
	public function r_listas_usuario($token) //LISTO
>>>>>>> e279d50609a197b9d9b45fc3d162851700515402
	{        
            $postdata = http_build_query(
                array(
                    'accion' => 'r_listas_usuario',
                    'token' => $token
                )
            );

           echo $this->respuesta($postdata);
           #return json_decode($this->respuesta($postdata));            
            
        }   
        
        public function transferir_r($token,$idu,$mto){
            $postdata = http_build_query(
                array(
                    'accion' => 'transferir_r',
                    'token' => $token,
                    'idu' => $idu,
                    'mto' => $mto
                )
            );

           echo $this->respuesta($postdata);            
        }

        public function retira_r($token,$idu,$mto){
            $postdata = http_build_query(
                array(
                    'accion' => 'retira_r',
                    'token' => $token,
                    'idu' => $idu,
                    'mto' => $mto
                )
            );

           echo $this->respuesta($postdata);            
        }
        
        public function r_new_password($token,$idu,$psw){
            $postdata = http_build_query(
                array(
                    'accion' => 'r_new_password',
                    'token' => $token,
                    'idu' => $idu,
                    'psw' => $psw
                )
            );
            echo $this->respuesta($postdata);            
        }
        
        public function r_bloquea_desbloquea_user($token,$idu){
            $postdata = http_build_query(
                array(
                    'accion' => 'r_bloquea_desbloquea_user',
                    'token' => $token,
                    'idu' => $idu
                )
            );            
            
           echo $this->respuesta($postdata);            
        }

        public function consulta_usr($token,$idu){
            $postdata = http_build_query(
                array(
                    'accion' => 'consulta_usr',
                    'token' => $token,
                    'idu' => $idu
                )
            );            
            
           echo $this->respuesta($postdata);            
        }

        public function generar_prepago($token,$mto,$tlf){
            $postdata = http_build_query(
                array(
                    'accion' => 'generar_prepago',
                    'token' => $token,
                    'mto' => $mto,
                    'tlf'  => $tlf
                )
            );            
            
           echo $this->respuesta($postdata);            
        }

        public function r_retiro_consulta($token){
            $postdata = http_build_query(
                array(
                    'accion' => 'r_retiro_consulta',
                    'token' => $token
                )
            );            
            
           echo $this->respuesta($postdata);            
        }

        public function r_retiro_($token,$mto){
            $postdata = http_build_query(
                array(
                    'accion' => 'r_retiro_',
                    'token' => $token,
                    'mto' => $mto
                )
            );            
            
           echo $this->respuesta($postdata);            
        }

        public function valida_clave_ret($token,$clv){
            $postdata = http_build_query(
                array(
                    'accion' => 'valida_clave_ret',
                    'token' => $token,
                    'clv' => $clv
                )
            );            
            
           echo $this->respuesta($postdata);            
        }
        
        public function procesar_retiro_ret($token,$idr){
            $postdata = http_build_query(
                array(
                    'accion' => 'procesar_retiro_ret',
                    'token' => $token,
                    'idr' => $idr
                )
            );            
            
           echo $this->respuesta($postdata);            
        }        

        public function recargar_rw_tarjeta($token,$cod){
            $postdata = http_build_query(
                array(
                    'accion' => 'recargar_rw_tarjeta',
                    'token' => $token,
                    'cod' => $cod
                )
            );            
            
           echo $this->respuesta($postdata);            
        }

        public function login_casino($token,$tp_usuario,$tjuego){
            $postdata = http_build_query(
                array(
                    'accion' => 'login_casino',
                    'token' => $token,
                    'tp_usuario' => $tp_usuario,
                    'id_tjuego' => $tjuego
                )
            );
           return $this->respuesta($postdata);            
        } 


        public function set_tmz($token,$toff,$tmz,$tp_usuario){
            $postdata = http_build_query(
                array(
                    'accion' => 'set_tmz',
                    'token' => $token,
                    'toff' => $toff,
                    'tmz' => $tmz,
                    'tp_usuario' => $tp_usuario
                )
            );  
            echo $this->respuesta($postdata);
        }        

        public function consulta_vta_retail_web($token,$tp_usuario,$fecha1,$fecha2){
            $postdata = http_build_query(
                array(
                    'accion' => 'consulta_vta_retail_web',
                    'token' => $token,
                    'tp_usuario' => $tp_usuario,
                    'fecha1' => $fecha1,
                    'fecha2' => $fecha2
                    
                )
            );  
            echo $this->respuesta($postdata);
        }
        
        public function consulta_remoto($token){
            $postdata = http_build_query(
                array(
                    'accion' => 'consulta_remoto',
                    'token' => $token
                )
            );  
            echo $this->respuesta($postdata);
        }        
        
/* Maquina de ruleta o slots */
        public function consulta_lista_maquina($token){
            $postdata = http_build_query(
                array(
                    'accion' => 'consulta_lista_maquina',
                    'token' => $token
                )
            );  
            return $this->respuesta($postdata);
        }        
  
        public function acreditar_mq($token,$idm,$mto,$puesto){
            $postdata = http_build_query(
                array(
                    'accion' => 'acreditar_mq',
                    'token' => $token,
                    'idm'=> $idm,
                    'mto'=> $mto,
                    'puesto'=>$puesto
                )
            );  
            return $this->respuesta($postdata);
        }         
        
        public function lista_retiros_mq($token,$id,$fecha,$estatus,$tipo){
            $postdata = http_build_query(
                array(
                    'accion' => 'lista_retiros_mq',
                    'token' => $token,
                    'idm' => $id,
                    'fecha' => $fecha,
                    'estatus' => $estatus,
                    'tipo'  => $tipo
                )
            );  
            return $this->respuesta($postdata);
        }  
        
        public function confirma_retiro_mq($token,$id_proceso){
            $postdata = http_build_query(
                array(
                    'accion' => 'confirma_retiro_mq',
                    'token' => $token,
                    'id_proceso' => $id_proceso
                )
            );  
            return $this->respuesta($postdata);
        }         
        public function contadores_ruleta($token,$dfecha,$hfecha){
            $postdata = http_build_query(
                array(
                    'accion' => 'contadores_ruleta',
                    'token' => $token,
                    'dfecha' => $dfecha,
                    'hfecha' => $hfecha
                )
            );  
            return $this->respuesta($postdata);
        }        
        
	public function __destruct() {
		#@curl_close($this->ch);
	}
        
}



?>

