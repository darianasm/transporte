<?php

include 'Viaje.php';
include 'Pasajero.php';
include 'Responsable.php';
include 'Terrestre.php';
include 'Aereo.php';

$pasajero[0] = new Pasajero("Dariana","Sosa",96023820,2995344876);

$responsable = new Responsable(1,98765,"Pablo","Herrera");

$terrestre = new Terrestre (12345,"bariloche",10,$pasajero, $responsable, 500, "no", "cama");

$aereo = new Aereo (12345,"bariloche",8,$pasajero, $responsable, 600, "no", 1, "si", "airlains",3);

