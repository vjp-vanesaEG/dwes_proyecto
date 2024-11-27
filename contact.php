<?php

require_once "utils/utils.php";
require_once 'entities/Mensaje.class.php';
require_once 'entities/repository/MensajeRepositorio.class.php';
require_once 'exceptions/AppException.class.php';
require_once 'exceptions/Fileexception.class.php';
require_once 'exceptions/QueryException.class.php';
require_once 'entities/QueryBuilder.class.php';
require_once 'entities/Connection.class.php';
require_once 'entities/App.class.php';

//Validación del formulario para que todos los datos que se envíen sean correctos.
//En el caso de que no fuera así se mostrarán mensajes con los errores correspondientes.
//Si introduce bien los datos se mostrarán como han quedado guardados.


$errores = [];
$descripcion = '';


$nombre = '';
$apellido = '';
$asunto = '';
$email = '';
$texto = '';
try {

    //Crea una conexión con la BBDD
    $config = require_once 'app/config.php';
    App::bind('config', $config);

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
