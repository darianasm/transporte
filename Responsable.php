<?php

class Responsable{
    
    private $numEmpleado;
    private $numLicencia;
    private $nombre;
    private $apellido;

    public function  __construct($empleado, $licencia, $name,$apelli){
        // Metodo constructor de la clase Responsable
        $this->numEmpleado = $empleado;
        $this->numLicencia = $licencia;
        $this->nombre = $name;
        $this->apellido = $apelli;
    }
    
    //Metodos de acceso
    public function getNumEmpleado(){
    return $this->numEmpleado;
    }
    public function setNumEmpleado($numEmpleado){
    $this->numEmpleado = $numEmpleado;
    }
    public function getNumLicencia(){
    return $this->numLicencia;
    }
    public function setNumLicencia($numLicencia){
    $this->numLicencia = $numLicencia;
    }
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
    
    //Metodo de convertir a string
    public function __toString(){
        return "\nNúmero de Empleado: ".$this->getNumEmpleado().
               "\nNúmero de Licencia: ".$this->getNumLicencia().
               "\nNombre: ".$this->getNombre().
               "\nApellido: ".$this->getApellido()."\n";
        }
}

?>