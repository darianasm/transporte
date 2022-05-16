<?php

class Aereo extends Viaje{

private $numeroVuelo;
private $categAsiento; //primera clase o no
private $nombreAerolinea; 
private $cantEscalas; // del vuelo en caso de tenerlas

public function __construct ($codigoViaje, $destinoViaje, $cantMaxPasajeros, $responsable, $import, 
                             $idaVuel, $numVuelo, $categoriaAsien, $nombreAerolin, $numEscalas){

parent::__construct($codigoViaje, $destinoViaje, $cantMaxPasajeros, $responsable, $import, $idaVuel);

$this->numeroVuelo = $numVuelo;     
$this->categAsiento = $categoriaAsien;
$this->nombreAerolinea = $nombreAerolin;     
$this->cantEscalas = $numEscalas;
}

public function getNumeroVuelo(){
return $this->numeroVuelo;
}
public function setNumeroVuelo($numeroVuelo){
$this->numeroVuelo = $numeroVuelo;
}
public function getCategAsiento(){
return $this->categAsiento;
}
public function setCategAsiento($categAsiento){
$this->categAsiento = $categAsiento;
}
public function getNombreAerolinea(){
return $this->nombreAerolinea;
}
public function setNombreAerolinea($nombreAerolinea){
$this->nombreAerolinea = $nombreAerolinea;
}
public function getCantEscalas(){
return $this->cantEscalas;
}
public function setCantEscalas($cantEscalas){
$this->cantEscalas = $cantEscalas;
}

public function __toString (){
$cadena = "\n---Viaje Aereo---\n".parent::__toString();

$cadena .= "Número de Vuelo: ".$this->getNumeroVuelo()."\n".
           "Categoria de asiento: ".$this->getCategAsiento()."\n".
           "Nombre de la Aerolínea: ".$this->getNombreAerolinea()."\n".
           "Cantidad de escalas: ".$this->getCantEscalas()."\n";

return $cadena;
}

public function venderPasaje($pasajero){
$importe = parent::getImporte();
$asiento = $this->getCategAsiento();
$escalas = $this->getCantEscalas();

if(strnatcasecmp($asiento,"si")){

    if($escalas == 0){
    $importe = $importe + (($importe * 40)/100);
    }else{
    $importe = $importe + (($importe * 60)/100);
    }

}

$importe = $importe*(parent::venderPasaje($pasajero));

return $importe;
}
}
?>