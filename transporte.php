<?php

class Tranporte{
private $codigoViaje;
private $destinoViaje;
private $cantMaxPasajeros;
private $pasajeroViaje;//$pasajeroViaje =["nombre"=>$nombre,"apellido"=>$apellido,"docu"=>$docu];

// Metodo constructor de la clase Transporte
public function  __construct($codigo, $destino, $cantMax, $pasajero){   
    $this->codigoViaje = $codigo;
    $this->destinoViaje = $destino;    
    $this->cantMaxPasayeros = $cantMax;    
    $this->pasajeroViaje = $pasajero;     
}
// Metodos de acceso
public function getCodigoViaje(){
return $this->codigoViaje;
}
public function setCodigoViaje($codigoViaje){
$this->codigoViaje = $codigoViaje;
}
public function getDestinoViaje(){
return $this->destinoViaje;
}
public function setDestinoViaje($destinoViaje){
$this->destinoViaje = $destinoViaje;
}
public function getCantMaxPasajeros(){
return $this->cantMaxPasajeros;
}
public function setCantMaxPasajeros($cantMaxPasajeros){
$this->cantMaxPasajeros = $cantMaxPasajeros;
}
public function getPasajeroViaje(){
return $this->pasajeroViaje;
}
public function setPasajeroViaje($pasajeroViaje){
$this->pasajeroViaje = $pasajeroViaje;
}
}

?>