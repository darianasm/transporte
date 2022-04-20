<?php

class Pasajero{

private $nombre;
private $apellido;
private $documento;
private $telefono;

public function  __construct($nombre, $apellido, $dni,$telefono){
    // Metodo constructor de la clase pasajero
    $this->nombre = $nombre;
    $this->apellido = $apellido;
    $this->documento = $dni;
    $this->telefono = $telefono;
}

//metodos de acceso
public function getNombre(){
return $this->nombre;
}
public function setNombre($nombre){
$this->nombre = $nombre;
}
public function getApellido(){
return $this->apellido;
}
public function setApellido($apellido){
$this->apellido = $apellido;
}
public function getDocumento(){
return $this->documento;
}
public function setDocumento($documento){
$this->documento = $documento;
}
public function getTelefono(){
return $this->telefono;
}
public function setTelefono($telefono){
$this->telefono = $telefono;
}

//metodo que convierte a string
public function __toString(){
    return "\nNombre: ".$this->getNombre().
           "\nApellido: ".$this->getApellido().
           "\nNúmero de documento: ".$this->getDocumento().
           "\nTeléfono: ".$this->getTelefono()."\n";
    }

}
?>