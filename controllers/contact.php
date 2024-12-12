<?php

//Validación del formulario para que todos los datos que se envíen sean correctos.
//En el caso de que no fuera así se mostrarán mensajes con los errores correspondientes.
//Si introduce bien los datos se mostrarán como han quedado guardados.

use proyecto\entities\App;
use proyecto\entities\Mensaje;
use proyecto\exceptions\PDOException;
use proyecto\exceptions\FileException;
use proyecto\exceptions\QueryException;
use proyecto\exceptions\AppException;

$errores = [];
$descripcion = '';


$nombre = '';
$apellido = '';
$asunto = '';
$email = '';
$texto = '';
try {

    //Uso: realizar INSERT y SELECT con la BBDD
    $mensajeRepositorio = new MensajeRepositorio();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') { //Post para comprobar que el formulario es enviado.
        $erroresF = [];
        $datos = [];
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $email = $_POST['email'];
        $asunto = $_POST['asunto'];
        $texto = $_POST['mensaje'];
        $errorEmail = [];

        //Comprobaciones por si no cumplen lo requerido.
        if (empty($nombre)) {
            $erroresF[] = "El campo First Name no puede estar vacío";
        } else {
            $datos[] = "Nombre: " . $nombre;
        }

        if (empty($email)) {
            $erroresF[] = "El campo Email está vacío";
        } else {
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $datos[] =  "Email: " . $email;
            } else {
                $errorEmail[] = 'Email inválido';
            }
        }

        if (empty($asunto)) {
            $erroresF[] = "El campo Subject está vacío";
        } else {
            $datos[] = "Asunto: " . $asunto;
        }

        if (!empty($apellido)) {
            $datos[] = "Apellidos: " . $apellido;
        }

        if (!empty($texto)) {
            $datos[] = "Mensaje: " . $texto;
        }
    }

    //Crear el mensaje y guardarlo, siempre que los datos estén completos.
    if(isset($erroresF) && empty($erroresF) && empty($errorEmail)){
        $mensaje = new Mensaje($nombre, $apellido, $asunto, $email, $texto);
        $mensajeRepositorio->save($mensaje);
    }
   
   
} catch (FileException $exception) {
    $errores[] = $exception->getMessage();
} catch (QueryException $exception) {
    $errores[] = $exception->getMessage();
} catch (AppException $exception) {
    $errores[] = $exception->getMessage();
} catch (PDOException $exception) {
    $errores[] = $exception->getMessage();
}


require_once "views/contact.views.php";
