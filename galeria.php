<?php

require_once 'utils/ultis.php';
require_once 'entities/File.class.php';
require_once 'entities/imagenGaleria.class.php';
require_once 'entities/Connection.class.php';
require_once 'entities/QueryBuilder.class.php';
require_once 'exceptions/AppException.class.php';
require_once 'entities/repository/ImagenGaleriaRepositorio.class.php';

$errores = [];
$descripcion = '';
$mensaje = '';


try {
    $config = require_once 'app/config.php';

    App::bind('config', $config);

    $imagenRepositorio = new ImagenGaleriaRepositorio();
    $connection = App::getConnection();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $descripcion = trim(htmlspecialchars($_POST['descripcion']));
        $tiposAceptados = ['image/jpeg', 'image/jpg', 'image/gif', 'image/png'];
        $imagen = new File('imagen', $tiposAceptados);
        //$imagen->saveUploadedFile(imagenGaleria::rutaImagenesGallery);
        $imagen->copyFile(ImagenGaleria::rutaImagenesGallery, ImagenGaleria::rutaImagenesPortfolio);
        
        $imagenGaleria = new ImagenGaleria($imagen->getFileName(),$descripcion);
        $imagenRepositorio->save($imagenGaleria);
        $descripcion ='';
        $mensaje = 'Imagen guardada';

        // $querySql = 'Select * from imagenes';
        // $queryStatement = $connection->query($querySql);
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

} catch (FileException $exception) {
    $errores[] = $exception->getMessage();
} catch (QueryException $exception) {
    $errores[] = $exception->getMessage();
} catch (AppException $exception) {
    $errores[] = $exception->getMessage();
} catch (PDOException $exception) {
    $errores[] = $exception->getMessage();
}finally{
    $imagenes = $imagenRepositorio->findAll();}

require_once 'views/galeria.view.php';
