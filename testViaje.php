<?php



include 'Viaje.php';
include 'Pasajero.php';

$pasajero[0] = new Pasajero("Dariana","Sosa",96023820,2995344876);
$pasajero[1] = new Pasajero("Erika","Muñoz",96023823,2995186314);
$viaje = new Viaje (12345,"bariloche",10,$pasajero);


opciones($viaje);
/**
 * función que da un menú para realizar lo que quiera el usuario
 * @param object $datosViaje
 * 
 */
function opciones($datosViaje){
do{
    echo "------Menú de opciones del viaje------\n"
        ."1) Ingresar datos.\n"
        ."2) Modificar datos.\n"
        ."3) Ver datos.\n"
        ."4) Salir.\n";
    
    echo "Ingrese su eleccion: ";
    $eleccion = trim(fgets(STDIN));

    //sale del programa o llama a los metodos dependiendo de la elección del usuario
    switch($eleccion){
        case 1:ingresarDatos($datosViaje);break;
        case 2:modificarDatos($datosViaje);break;
        case 3:mostrarDatos($datosViaje);break;
        case 4:echo "Programa finalizado";break;
        default:echo "Elección ingresada no valida, intente otra vez";break;
    }
}while($eleccion!=4);
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

$viaje->setCodigoViaje($cod);
$viaje->setDestinoViaje($desti);
$viaje->setCantMaxPasajeros($maxima);
ingresarPasajeros($maxima, $viaje);
}

/**
 * Función que carga los datos de los pasajeros ingresados por el usuario
 * @param int $cantMaxima;
 * @param object $datosViaje;
 * @return array $pasajero;
 */
function ingresarPasajeros($cantMaxima,$datosViaje){
$i = 0;
$seguir = "si";
echo "---Ingrese pasajeros---\n";

//strcasemp() para comparar el 'si' sin importar las mayúsculas o minúsculas
while(strcasecmp($seguir,"Si")==0 && $i<$cantMaxima){

    echo "Ingrese nombre del pasajero: ";
    $nombre = trim(fgets(STDIN));
    echo "Ingrese apellido del pasajero: ";
    $apellido = trim(fgets(STDIN));
    echo "Ingrese número de documento: ";
    $nroDocu = trim(fgets(STDIN));
    echo "Ingrese número de Teléfono: ";
    $tlfno = trim(fgets(STDIN));

    $pasajero[$i] = new Pasajero($nombre,$apellido,$nroDocu,$tlfno);
    $i++;

    if($i == $cantMaxima){
        echo "Ya llegó a la cantidad límite de pasajeros\n";
    }else{
        echo "¿Desea seguir ingresando más pasajeros?\nIngrese 'Si' para continuar, 'No' para parar: ";    
        $seguir = trim(fgets(STDIN));
    }
}
    $datosViaje->setPasajerosViaje($pasajero);
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
            ."5) Volver al Menú Principal.\n";
        
        echo "Ingrese su eleccion: ";
        $eleccion = trim(fgets(STDIN));
        
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
                        $viaje->setCantMaxPasajeros($cantNueva);break;
            case 4:modificarPasajeros($viaje);break;
            case 5: echo "Volviendo al menú principal...\n";break;
            default:echo "Elección inexistente, ingrese otra\n";break;
        }
    }while($eleccion!=5);

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
                        echo "__Ingrese Datos del pasajero que desea agregar__\n";
                        echo "Ingrese nombre: ";
                        $nombreNuevo = trim(fgets(STDIN));
                        echo "Ingrese apellido: ";
                        $apellidoNuevo = trim(fgets(STDIN));
                        echo "Ingrese número de documento: ";
                        $docuNuevo = trim(fgets(STDIN));
                        echo "Ingrese número de Telefono: ";
                        $tlfnoNuevo = trim(fgets(STDIN));
                        $pasajeroNuevo = new Pasajero($nombreNuevo,$apellidoNuevo,$docuNuevo,$tlfnoNuevo);
                        $datos->agregarPasajero($pasajeroNuevo);
                        echo "Los nuevos datos de los pasajeros son: ".$datos->stringPasajeros();
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
                        $datosViaje->setPasajerosViaje($datosPasajero);
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
 * muestra los datos de un obejeto
 * @param object $datos;
 */
function mostrarDatos($datos){
echo $datos;
}
?>

 * Modificar la clase Viaje para que ahora los pasajeros sean un objeto que tenga los atributos 
   nombre, apellido, numero de documento y teléfono. 
   
 * El viaje ahora contiene una referencia a una colección de objetos de la clase Pasajero. 
  
 * También se desea guardar la información de la persona responsable de realizar el viaje, 
   para ello cree una clase ResponsableV que registre el número de empleado, número de licencia, nombre y apellido. 
  
 * La clase Viaje debe hacer referencia al responsable de realizar el viaje.
  
 * Volver a implementar las operaciones que permiten modificar el nombre, apellido y teléfono de un pasajero. 
 
 * Luego implementar la operación que agrega los pasajeros al viaje, solicitando por consola la información de los mismos. 
 
 * Se debe verificar que el pasajero no este cargado mas de una vez en el viaje. 
 
 * De la misma forma cargue la información del responsable del viaje.
  
 * Nota: Recuerden que deben enviar el link a la resolución en su repositorio en GitHub
 