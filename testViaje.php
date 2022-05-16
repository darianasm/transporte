<?php

include 'Viaje.php';
include 'Pasajero.php';
include 'Responsable.php';
include 'Terrestre.php';
include 'Aereo.php';

$responsable1 = new Responsable(1,98765,"Pablo","Herrera");
$pasajero[0] = new Pasajero("Dariana","Sosa",96023820,2995344876);
$pasajero[1] = new Pasajero("Erika","Muñoz",96023823,2995186314);

$responsable2 = new Responsable(2,45832,"Jose","Lopez");
$pasajero[2] = new Pasajero("Dariana","Sosa",96023820,2995344876);
$pasajero[3] = new Pasajero("Diego","Herrera",96015823,299);

$viaje1 = new Terrestre (1,"bariloche",5,$responsable1, 500, "no", "cama");
$viaje2 = new Aereo (2,"venezuela",4, $responsable2, 100, "si", 3, "no", "airlains",2);

$pasajero[0]->setImporte($viaje2->venderPasaje($pasajero[0]));    
$pasajero[1]->setImporte($viaje2->venderPasaje($pasajero[1]));

opciones($viaje2);

/**
 * función que da un menú para realizar lo que quiera el usuario
 * @param object $datosViaje
 * 
 */
function opciones($datosViaje){

do{
    echo "\n------Menú de opciones del viaje------\n"
        ."1) Ingresar datos de un nuevo viaje.\n"
        ."2) Modificar datos.\n"
        ."3) Ver datos.\n"
        ."4) Salir.\n";
    
    echo "Ingrese su eleccion: ";
    $eleccion = trim(fgets(STDIN));

    //sale del programa o llama a los metodos dependiendo de la elección del usuario
    switch($eleccion){
        case 1:$datosViaje = ingresarTipoViaje();
        case 2:modificarDatos($datosViaje);break;
        case 3:mostrarDatos($datosViaje);break;
        case 4:echo "Programa finalizado";break;
        default:echo "Elección ingresada no valida, intente otra vez";break;
    }
}while($eleccion!=4);
}

function ingresarTipoViaje(){
echo "¿Desea ingresar Datos de un Viaje Terrestre o Aereo?
      A) Aereo
      T) Terrestre\n";

$tipoViaje = trim(fgets(STDIN));

switch($tipoViaje){
    case 'A':
            $responsable = new Responsable(0,0,"","");
            $viajeDat =  new Aereo (0,"",0, $responsable, 0, "", 0, "", "",0);
            ingresarDatos($viajeDat);
            
            echo "ingrese número de vuelo: ";
            $numVuelo = trim(fgets(STDIN));
            echo "ingrese si el viaje es primera clase o no: ";
            $primerClas = trim(fgets(STDIN));
            echo "ingrese nombre de la aerolinea: ";
            $aerolinea = trim(fgets(STDIN));
            echo "ingrese la cantidad de escalas que tendrá el viaje";
            $cantEsc = trim(fgets(STDIN));
            
            $viajeDat->setNumeroVuelo($numVuelo);
            $viajeDat->setCategAsiento($primerClas);
            $viajeDat->setNombreAerolinea($aerolinea);
            $viajeDat->setCantEscalas($cantEsc);break;

    case 'T':
            $responsable = new Responsable(0,0,"","");
            $viajeDat = new Terrestre (0,"",0,$responsable, 0, "", "");
            ingresarDatos($viajeDat);
            
            echo "ingrese si el asiento es semicama o cama: ";
            $asiento = trim(fgets(STDIN));

            $viajeDat->setComodidadAsiento($asiento);break;

    default:echo "Elección ingresada no valida, intente otra vez";break;
}
return $viajeDat;
}

/**
 * Función que ingresa Datos del viaje
 * @param object $viaje
 */
function ingresarDatos($viaje){

echo "Ingrese codigo del viaje: ";
$cod = trim(fgets(STDIN));
echo "Ingrese destino del viaje: ";
$desti = trim(fgets(STDIN));
echo "Ingrese cantidad maxima de pasajeros: " ;
$maxima = trim(fgets(STDIN));
echo "Ingrese importe del viaje: " ;
$importe = trim(fgets(STDIN));
echo "Ingrese si el viaje es de ida y vuelta: " ;
$idaYVuelta = trim(fgets(STDIN));

$viaje->setCodigoViaje($cod);
$viaje->setDestinoViaje($desti);
$viaje->setCantMaxPasajeros($maxima);
$viaje->setImporte($importe);
$viaje->setIdaVuelta($idaYVuelta);

ingresarPasajeros($viaje);
ingresarResponsable($viaje);

}

/**
 * Función que carga los datos de los pasajeros ingresados por el usuario
 * @param int $cantMaxima;
 * @param object $datosViaje;
 * @return array $pasajero;
 */
function ingresarPasajeros($datosViaje){
$cantMaxima = $datosViaje->getCantMaxPasajeros();
$i = 0;
$seguir = "si";
echo "---Ingrese pasajeros---\n";

//strcasemp() para comparar el 'si' sin importar las mayúsculas o minúsculas
while(strcasecmp($seguir,"Si")==0 && $datosViaje->hayPasajesDisponibles()){

    echo "Ingrese nombre del pasajero: ";
    $nombre = trim(fgets(STDIN));
    echo "Ingrese apellido del pasajero: ";
    $apellido = trim(fgets(STDIN));
    echo "Ingrese número de documento: ";
    $nroDocu = trim(fgets(STDIN));
    echo "Ingrese número de Teléfono: ";
    $tlfno = trim(fgets(STDIN));

    $pasajero[$i] = new Pasajero($nombre,$apellido,$nroDocu,$tlfno);
    
    if($datosViaje->encontrarIndice($nroDocu) != -1){
        echo "Este pasajero ya ha sido ingresado, ingrese otro\n";
    }else{
        echo "Importe a pagar: ". $pasajero[$i]->setImporte($datosViaje->venderPasaje($pasajero[$i]));    
    }
    $i++;

    if(!$datosViaje->hayPasajesDisponibles()){
        echo "Ya llegó a la cantidad límite de pasajeros\n";
    }else{
        echo "¿Desea seguir ingresando más pasajeros?\nIngrese 'Si' para continuar, 'No' para parar: ";    
        $seguir = trim(fgets(STDIN));
    }
}
echo "Los datos de los pasajeros actualmente son: ".$datosViaje->stringPasajeros();
}

function ingresarResponsable($datosViaje){

echo "---Ingrese datos del Responsable del Viaje---\n";
echo "Ingrese número de empleado: ";
$empleado = trim(fgets(STDIN));
echo "Ingrese número de licencia: ";
$licencia = trim(fgets(STDIN));
echo "Ingrese nombre: ";
$nombre = trim(fgets(STDIN));
echo "Ingrese apellido: ";
$apellido = trim(fgets(STDIN));

$datosViaje->getResponsable()->setNumEmpleado($empleado);
$datosViaje->getResponsable()->setNumLicencia($licencia);
$datosViaje->getResponsable()->setNombre($nombre);
$datosViaje->getResponsable()->setApellido($apellido);


}

/**
 * muestra menú de opciones para el datos del viaje que desee modificar el usuario
 * @param object $viaje;
 */
function modificarDatos($viaje){
    do{
        echo "------Ingrese dato que desea MODIFICAR del viaje------\n"
            ."1) Código.\n"
            ."2) Destino.\n"
            ."3) Cantidad MAXIMA de pasajeros.\n"
            ."4) Pasajeros.\n"
            ."5) Responsable.\n";
            
        if(get_class($viaje) == "Terrestre"){
        echo "6) Comodidad del asiento.\n";
        
        }elseif(get_class($viaje) == "Aereo"){
        echo "6) Número de vuelo.\n."
            ."7) Categoría del asiento.\n"
            ."8) Nombre de la aerolínea.\n"
            ."9) Cantidad de escalas.\n";
        }
        
        echo "0) Volver al Menú principal.\n";

        echo "Ingrese su eleccion: ";
        $eleccion = trim(fgets(STDIN));

        if($eleccion>= 6 && $eleccion<=9){
        modificarDatosTerrestre($eleccion,$viaje);
        modificarDatosAereo($eleccion,$viaje);
        }else{
        
        //llama al metodo escogido por el usuario 
        switch($eleccion){
            case 1:echo "Ingrese código del viaje nuevo: ";
                        $codNuevo = trim(fgets(STDIN));
                        $viaje->setCodigoViaje($codNuevo);break;
            case 2:echo "Ingrese destino del viaje nuevo: ";
                        $destNuevo = trim(fgets(STDIN));
                        $viaje->setDestinoViaje($destNuevo);break;
            case 3:echo "Ingrese cantidad maxima de pasajeros nueva del viaje: ";
                        $cantNueva = trim(fgets(STDIN));
                        if($cantNueva>count($viaje->getPasajerosViaje())){
                        $viaje->setCantMaxPasajeros($cantNueva);break;
                        }else{
                        echo "La cantidad nueva es menor a la cantidad de pasajeros ya ingresados.\n"; 
                        }
                        break;
            case 4:modificarPasajeros($viaje);break;
            case 5:modificarResponsable($viaje);break;
            case 0: echo "Volviendo al menú principal...\n";break;
            default:echo "Elección inexistente, ingrese otra\n";break;
        }
        }
    }while($eleccion!=0);

}

function modificarDatosTerrestre($eleccion,$viajeTerrestre){
echo "6) Comodidad del asiento.\n";
if($eleccion == 6){
    echo "Ingrese comodidad del asiento, si es semicama o cama: ";
    $comodidad = trim(fgets(STDIN));
    $viajeTerrestre->setComodidadAsiento($comodidad);
}
}

function modificaDatosAereo($eleccion,$viajeAereo){
echo "6) Número de vuelo.\n."
    ."7) Categoría del asiento.\n"
    ."8) Nombre de la aerolínea.\n"
    ."9) Cantidad de escalas.\n";

switch($eleccion){
    case 6:echo "Ingrese nuevo número de vuelo: ";
        $num = trim(fgets(STDIN));
        $viajeAereo->setNumeroVuelo($num);break;
    case 7:echo "Ingrese categoría del asiento, si es primera clase o no: ";
        $categ = trim(fgets(STDIN));
        $viajeAereo->setCategAsiento($categ);break;
    case 8:echo "Ingrese nombre nuevo de la aerolínea: ";
        $nom = trim(fgets(STDIN));
        $viajeAereo->setNombreAerolinea($nom);break;    
    case 9:echo "Ingrese nueva cantidad de escalas: ";
        $cant = trim(fgets(STDIN));
        $viajeAereo->setCantEscalas($cant);break;
    } 
}

/**
 * modifica los datos de los pasajeros
 * muestra un menú de lo que quiere hacer con la colección de pasajeros
 * @param object $datos;
 */
function modificarPasajeros($datos){
$datosPasajero = $datos->getPasajerosViaje();
$longPasajeros = count($datosPasajero);
$maxPasajeros = $datos->getCantMaxPasajeros();
echo "Los datos de los pasajeros actualmente son: \n".$datos->stringPasajeros();

    do{
        echo "------Ingrese que desea hacer con los datos de los pasajeros------\n"
            ."1) Eliminar un pasajero.\n"
            ."2) Agregar un pasajero.\n"
            ."3) Modificar los datos de un pasajero en específico.\n"
            ."4) Modificar dato del viaje.\n";
        
        echo "Ingrese su eleccion: ";
        $eleccion = trim(fgets(STDIN));
    
        //llama al metodo escogido por el usuario
        //por parametro entra el numero de documento del usuario ya que es único y así no hay repetidos
        //verifica primero que el documento esté registrado
        switch($eleccion){
            case 1:
                echo "ingrese número de documento del pasajero que desea eliminar: ";
                    $nroDocuEliminar = trim(fgets(STDIN));
                    if($datos->encontrarIndice($nroDocuEliminar) != -1){
                        $datos->eliminarPasajero($nroDocuEliminar);
                        echo "Los nuevos datos de los pasajeros son: ".$datos->stringPasajeros()."\n";
                    }else{
                    echo "El número de documento no se encuentra entre los pasajeros\n";
                    } 
                    break;
            case 2:
                    //verifica que no se haya superado el límite de pasajeros para poder agregar más
                    if($longPasajeros<$maxPasajeros){
                        ingresarPasajeros($datos);
                    }else{
                        echo "ya llegó al límite la cantidad de pasajeros,\n
                              si desea ingresar más pasajeros modifique la cantidad máxima de pasajeros";    
                    }
                    break;
            case 3:
                    echo "Ingrese número de documento del pasajero que desea modificar: ";
                    $nroDocuModificar = trim(fgets(STDIN));
                    if($datos->encontrarIndice($nroDocuModificar) != -1){
                    modificarDatosPasajero($datos->encontrarIndice($nroDocuModificar),$datos);
                    }else{
                    echo "El número de documento no se encuentra entre los pasajeros, intente otra vez\n";
                    } 
                    break;
            case 4: echo "Volviendo al menú de modificar datos del viaje...\n";break;
            default:"Elección inexistente, ingrese otra: ";break;
        }
    }while($eleccion!=4);
}

/**
 * función que modifica los datos de una pasajero en específico
 * @param int $indice;
 * @param object $datosViaje;
 */
function modificarDatosPasajero($indice,$datosViaje){
$datosPasajero = $datosViaje->getPasajerosViaje();
    do{
        echo "------Ingrese que datos desea modificar del pasajero------\n"
            ."1) Nombre.\n"
            ."2) Apellido.\n"
            ."3) Documento.\n"
            ."4) Volver.\n";
        
        echo "Ingrese su eleccion: ";
        $eleccion = trim(fgets(STDIN));
    
        switch($eleccion){
            case 1:echo "Ingrese nombre nuevo del pasajero: ";
                        $nombreNuevo = trim(fgets(STDIN));
                        $datosPasajero[$indice]->setNombre($nombreNuevo);
                        
                        break;
            case 2:echo "Ingrese apellido nuevo del pasajero: ";  
                        $apellidoNuevo = trim(fgets(STDIN));
                        $datosPasajero[$indice]->setNombre($apellidoNuevo);
                        $datosViaje->setPasajerosViaje($datosPasajero);
                        break;
            case 3:echo "Ingrese numero de documento nuevo del pasajero: ";
                        $docuNuevo = trim(fgets(STDIN));
                        $datosPasajero[$indice]->setNombre($docuNuevo);
                        $datosViaje->setPasajerosViaje($datosPasajero);
                        break;
            case 4: "Volviendo al menú de modificar la colección de pasajeros...\n";break;
            default:"Elección inexistente, ingrese otra";break;
        }
    }while($eleccion!=4);
}

/**
 * función que modifica los datos del responsable del viaje
 * @param object $datosViaje;
 */
function modificarResponsable($datosViaje){
$datosResponsable = $datosViaje->getResponsable();
        do{
            echo "------Ingrese que dato desea modificar del Responsable del viaje------\n"
                ."1) Número de Empleado.\n"
                ."2) Número de Licencia.\n"
                ."3) Nombre.\n"
                ."4) Apellido.\n"
                ."5) Volver (Modificar otro dato del viaje).\n";
            
            echo "Ingrese su eleccion: ";
            $eleccion = trim(fgets(STDIN));
        
            switch($eleccion){
                case 1:echo "Ingrese número nuevo del Empleado: ";
                            $numEmpleado = trim(fgets(STDIN));
                            $datosResponsable->setNumEmpleado($numEmpleado);
                            break;
                case 2:echo "Ingrese número nuevo de Licencia: ";  
                            $numLicencia = trim(fgets(STDIN));
                            $datosResponsable->setNumLicencia($numLicencia);
                            break;
                case 3:echo "Ingrese nombre nuevo: ";
                            $nombreNuevo = trim(fgets(STDIN));
                            $datosResponsable->setNombre($nombreNuevo);
                            break;
                case 4:echo "Ingrese apellido nuevo: ";
                             $apellidoNuevo = trim(fgets(STDIN));
                             $datosResponsable->setApellido($apellidoNuevo);
                             break;
                case 5: "Volviendo al menú de modificar datos del viaje...\n";break;
                default:"Elección inexistente, ingrese otra";break;
            }
        }while($eleccion!=5);
}

/**
 * muestra los datos de el objeto viaje
 * @param object $datos;
 */
function mostrarDatos($datos){
echo $datos;
}
?>
 