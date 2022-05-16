<?php

class Terrestre extends Viaje{

private $comodidadAsiento;// si es semicama o cama.

public function __construct ($codigoViaje, $destinoViaje, $cantMaxPasajeros, $responsable, $import, 
                             $idaVuel, $comodAsiento){
parent::__construct($codigoViaje, $destinoViaje, $cantMaxPasajeros, $responsable, $import, $idaVuel);
$this->comodidadAsiento = $comodAsiento;
}

public function getComodidadAsiento(){
return $this->comodidadAsiento;
}
public function setComodidadAsiento($comodidadAsiento){
$this->comodidadAsiento = $comodidadAsiento;
}

public function __toString (){
$cadena = "\n---Viaje Terrestre---\n".parent::__toString();
$cadena .= "Comodidad del asiento: ".$this->getComodidadAsiento()."\n";
return $cadena;
}

public function venderPasaje($pasajero){
$importe = parent::getImporte();
$asiento = $this->getComodidadAsiento();

if(strnatcasecmp($asiento,"cama")){
$importe = $importe + (($importe * 25)/100);
}

$importe = $importe* (parent::venderPasaje($pasajero));

return $importe;
}
}

?>