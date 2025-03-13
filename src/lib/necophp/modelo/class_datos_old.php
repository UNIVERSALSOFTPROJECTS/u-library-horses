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
                $context  = stream_context_create($opts);
                $contents = file_get_contents($this->url, false, $context);
                #print_r($contents);
                $contents = utf8_encode($contents);
                //$results = json_decode($contents);                
                #print_r($results);
                return $contents;
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
        
	public function login($usuario, $pass)
	{
                $postdata = http_build_query(
                    array(
                        'accion' => 'login',
                        'usr' => $usuario,
                        'pass' => $pass,
                        'xyz' => '9999'
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

	public function apuestas_realizadas($token,$xfecha,$xhipodromo,$xstatus)
	{
                $postdata = http_build_query(
                    array(
                        'accion' => 'apr',
                        'token' => $token,
                        'fecha' => $xfecha,
                        'hipodromo' => $xhipodromo,
                        'estatus' => $xstatus
                    )
                );
                 
               return $this->respuesta($postdata);
	}        
        
	public function lista_hipodromos($Atoken)
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
	public function resultados_dia($token,$fecha)
	{        
            $postdata = http_build_query(
                array(
                    'accion' => 'resultados_dia',
                    'token' => $token,
                    'fecha'=> $fecha
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
        
	public function resultados_hipodromo2($token,$fecha,$id_pista)
	{        
            $postdata = http_build_query(
                array(
                    'accion' => 'resultados_hipodromo2',
                    'token' => $token,
                    'fecha'=> $fecha,
                    'id_pista'=> $id_pista
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
        
        public function solicita_retiro($token,$monto){
            $postdata = http_build_query(
                array(
                    'accion' => 'solicita_retiro',
                    'token' => $token,
                    'monto' => $monto
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
        public function registro_pago_trans($token,$tbd,$tf,$tr,$tm,$to,$octa){
            $postdata = http_build_query(
                array(
                    'accion' => 'registro_pago_trans',
                    'token' => $token,
                    'tbd' => $tbd,
                    'tf' => $tf,
                    'tr' => $tr,
                    'tm' => $tm,
                    'to' => $to,
                    'octa' => $octa
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
        
        public function busca_retirados_carreras($token,$id_crr){
            $postdata = http_build_query(
                array(
                    'accion' => 'busca_retirados_carreras',
                    'token' => $token,
                    'id_crr' => $id_crr
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
        
        public function hipodromos_activos($token){
            $postdata = http_build_query(
                array(
                    'accion' => 'hipodromos_activos',
                    'token' => $token
                )
            );            
            return $this->respuesta($postdata);
        }
        
        public function resultados_detalle_carrera2($token,$fecha,$id_pista,$carrera){
            $postdata = http_build_query(
                array(
                    'accion' => 'resultados_detalle_carrera2',
                    'token' => $token,
                    'fecha'=> $fecha,
                    'id_pista'=> $id_pista,
                    'carrera'=> $carrera
                )
            );
           return $this->respuesta($postdata);            
        }

        public function apuestas_minimas($token){
            $postdata = http_build_query(
                array(
                    'accion' => 'apuestas_minimas',
                    'token' => $token
                )
            );            
            return $this->respuesta($postdata);
        }        

	public function __destruct() {
		@curl_close($this->ch);
	}
        
}



?>

