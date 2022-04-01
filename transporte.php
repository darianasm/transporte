<?php

class Transporte{
private $codigoViaje;
private $destinoViaje;
private $cantMaxPasajeros;
private $pasajerosViaje;//$pasajeroViaje =["nombre"=>$nombre,"apellido"=>$apellido,"docu"=>$docu];

// Metodo constructor de la clase Transporte
public function  __construct($codigo, $destino, $cantMax, $pasajero){   
    $this->codigoViaje = $codigo;
    $this->destinoViaje = $destino;    
    $this->cantMaxPasayeros = $cantMax;    
    $this->pasajerosViaje = $pasajero;     
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
public function getPasajerosViaje(){
return $this->pasajerosViaje;
}
public function setPasajerosViaje($pasajerosViaje){
$this->pasajerosViaje = $pasajerosViaje;
}
//Metodo para convertir en string
public function __toString(){
    return "Codigo de viaje:".$this->getCodigoViaje().
           "\nDestino del viaje:".$this->getDestinoViaje().
           "\nLa cantidad maxima de pasajeros es de:".$this->getcantMaxPasajeros().
           "\nLos datos los pasajeros son:".
           "\n".print_r($this->getPasajerosViaje());
}
}

?>