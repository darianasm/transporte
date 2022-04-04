<?php

class Viaje{
private $codigoViaje;
private $destinoViaje;
private $cantMaxPasajeros;
private $pasajerosViaje;//$pasajeroViaje =["nombre"=>$nombre,"apellido"=>$apellido,"nroDocu"=>$docu];

// Metodo constructor de la clase Viaje
public function  __construct($codigo, $destino, $cantMax, $pasajero){   
    $this->codigoViaje = $codigo;
    $this->destinoViaje = $destino;    
    $this->cantMaxPasayeros = $cantMax;    
    $this->pasajerosViaje = $pasajero;     
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
    if($pasajeros[$i]["nroDocu"] != $docu){
    $pasajeroNuevo[$j] = $pasajeros[$i];
    $j++;
    }
}
$this->setPasajerosViaje($pasajeroNuevo);
}

/**
 * crea una variable string con los datos de los pasajeros
 * @return string $string;
 */
public function stringPasajeros(){
$pasajeros = $this->getPasajerosViaje();
$string = " ";
$j = 1;
for($i = 0; $i<(count($pasajeros));$i++){
$string = $string.
          "\nPASAJERO ".($j++)
         ."\nNombre: ".$pasajeros[$i]["nombre"]
         ."\nApellido: ".$pasajeros[$i]["apellido"]
         ."\nNúmero de Documento: ".$pasajeros[$i]["nroDocu"]."\n";
}

return $string;
}

/**
 * agregar un arreglo aosciativo de un pasajero a una colección de pasajeros
 * modifica el arreglo de pasajeros anterior
 * @param array $pasajero
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
if($pasajeros[$i]["nroDocu"] == $docu){
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
           "\nLa cantidad maxima de pasajeros es de: ".$this->getcantMaxPasajeros().
           "\nLos datos los pasajeros son: ".$this->stringPasajeros();
}
}

?>