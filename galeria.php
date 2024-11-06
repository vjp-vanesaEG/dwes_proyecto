<?php

require 'utils/ultis.php';
require 'entities/File.class.php';
require 'entities/imagenGaleria.class.php';
require 'entities/Connection.class.php';
require_once 'entities/QueryBuilder.class.php';
require_once 'exceptions/AppException.class.php';

$errores = [];
$descripcion = '';
$mensaje = '';


try {
    $config = require_once 'app/config.php';

    App::bind('config', $config);
    $connection = App::getConnection();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $descripcion = trim(htmlspecialchars($_POST['descripcion']));
        $tiposAceptados = ['image/jpeg', 'image/jpg', 'image/gif', 'image/png'];
        $imagen = new File('imagen', $tiposAceptados);
        // $imagen->saveUploadedFile(imagenGaleria::rutaImagenesGallery);
        $sql = "INSERT INTO imagenes(nombre,descripcion) VALUES (:nombre, :descripcion)";
        $pdoStatement = $connection->prepare($sql);
        $parametersStatementArray = [':nombre' => $imagen->getFileName(), ':descripcion' => $descripcion];
        $respuesta = $pdoStatement->execute($parametersStatementArray);
        if ($respuesta === false) {
            $errores[] = 'No se ha podido guardar la imagen en la base de datos';
        } else {
            $descripcion = '';
            $mensaje = 'imagen guardada';
        }
        $querySql = 'Select * from imagenes';
        $queryStatement = $connection->query($querySql);
        // while ($row = $queryStatement->fetch()) {
        //     //row =['id'->1,'nombre->'', 'descipcion->''']
        //     echo 'ID : ' . $row['id'];
        //     echo 'Nombre :' . $row['nombre'];
        //     echo 'Descripción : ' . $row['descripcion'];
        //     echo 'Número Visualizaciones :' . $row['numVisualizaciones'];
        //     echo 'Número Likes : ' . $row['numLikes'];
        //     echo 'Número Downloads :' . $row['numDownloads'];
        // }
    }

    $queryBuilder = new QueryBuilder($connection);
    $imagenes = $queryBuilder->findAll('imagenes', 'imagenGaleria');
} catch (FileException $exception) {
    $errores[] = $exception->getMessage();
} catch (QueryException $exception) {
    $errores[] = $exception->getMessage();
} catch (AppException $exception) {
    $errores[] = $exception->getMessage();
}

require 'views/galeria.view.php';
