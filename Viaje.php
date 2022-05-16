<?php

class Viaje{
private $codigoViaje;
private $destinoViaje;
private $cantMaxPasajeros;
private $pasajerosViaje;//$pasajero[0] = new Pasajero(Dariana,Sosa,96023820,2995344876);
private $responsable;//$responsable = new Responsable(1,98765,"Pablo","Herrera");
private $importe;
private $idaVuelta;

// Metodo constructor de la clase Viaje
public function  __construct($codigo, $destino, $cantMax, $respon, $import, $idaVuel){   
    $this->codigoViaje = $codigo;
    $this->destinoViaje = $destino;    
    $this->cantMaxPasajeros = $cantMax;    
    $this->pasajerosViaje = [];     
    $this->responsable = $respon;
    $this->importe = $import;     
    $this->idaVuelta = $idaVuel;
}

// Metodos de acceso de la clase Viaje
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
public function getResponsable(){
return $this->responsable;
}
public function setResponsable($responsable){
$this->responsable = $responsable;
}
public function getIdaVuelta(){
return $this->idaVuelta;
}
public function setIdaVuelta($idaVuelta){
$this->idaVuelta = $idaVuelta;
}
public function getImporte(){
return $this->importe;
}
public function setImporte($importe){
$this->importe = $importe;
}

/**
 * crea una nueva colección omitiendo al pasajero según su nro de deocumento
 * modifica la colección
 * @param int $docu
 */
public function eliminarPasajero($docu){
$pasajeros = $this->getPasajerosViaje();
$pasajeroNuevo = [];
$j = 0;
for($i = 0; $i< count($pasajeros);$i++){
    if($pasajeros[$i]->getDocumento != $docu){
    $pasajeroNuevo[$j] = $pasajeros[$i];
    $j++;
    }
}
$this->setPasajerosViaje($pasajeroNuevo);
}

/**
 * crea una variable string con los datos de los pasajeros
 * @return String $string;
 */
public function stringPasajeros(){
$pasajeros = $this->getPasajerosViaje();
$string = " ";
$j = 1;
for($i = 0; $i<(count($pasajeros));$i++){
$string = $string.
          "\nPASAJERO ".($j++)
         .$pasajeros[$i];
         
}
return $string;
}

/**
 * agregar un arreglo aosciativo de un pasajero a una colección de pasajeros
 * modifica el arreglo de pasajeros anterior
 * @param object $pasajero
 */
public function agregarPasajero($pasajero){
$pasajeros = $this->getPasajerosViaje();
array_push($pasajeros,$pasajero);
$this->setPasajerosViaje($pasajeros);
}

/**
 * encuentra el indice en donde se encuentra el pasajero en el array según su nro de documento
 * si no encuentra el indice retorta -1
 * @param int $docu
 * @return int $encontrado;
 */
public function encontrarIndice($docu){
$pasajeros = $this->getPasajerosViaje();
$encontrado = -1;
$i=0;
while($i<count($pasajeros) && $encontrado == -1){
if($pasajeros[$i]->getDocumento() == $docu){
$encontrado = $i;
}
$i++;
}
return $encontrado;
}

//Metodo para convertir en string
public function __toString(){
    return "Codigo de viaje: ".$this->getCodigoViaje().
           "\nDestino del viaje: ".$this->getDestinoViaje().
           "\nLa cantidad maxima de pasajeros es de: ".$this->getCantMaxPasajeros().
           "\n\nLos datos los pasajeros son: \n".$this->stringPasajeros().
           "\nLos datos del responsable del viaje son: ".$this->getResponsable().
           "\nEl importe del viaje es: ".$this->getImporte().
           "\nEl viaje es de ida y vuelta: ".$this->getIdaVuelta()."\n";
}

public function venderPasaje($pasajero){
$idaVuel = $this->getIdaVuelta();
$multiplicar = null;

if($this->hayPasajesDisponibles()){
    $this->agregarPasajero($pasajero);
    $multiplicar = 1;
    if($idaVuel == "si"){
        $multiplicar = 2;
    }

}
return $multiplicar;
}

public function hayPasajesDisponibles(){
$cantPasajeros = count($this->getPasajerosViaje());
$maximaCant = $this->getCantMaxPasajeros();
$disponible = false;

if($cantPasajeros < $maximaCant){
$disponible = true;
}
return $disponible;
}

}

?>