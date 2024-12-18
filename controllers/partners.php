<?php

// require_once 'utils/utils.php';
// require_once 'entities/Partners.class.php';
// require_once 'entities/repository/PartnersRepositorio.class.php';
// require_once 'entities/App.class.php';
// require_once 'entities/ImagenGaleria.class.php';
// require_once 'exceptions/QueryException.class.php';
// require_once 'exceptions/AppException.class.php';
// require_once 'entities/File.class.php';

use proyecto\entities\PartnersRepositorio;
use proyecto\entities\ImagenGaleria;
use proyecto\entities\File;
use proyecto\entities\Partners;
use proyecto\entities\FileException;
use proyecto\entities\QueryException;
use proyecto\entities\AppException;

$errores = [];
$descripcion = '';
$mensaje = '';

try {

    //Uso: realizar INSERT y SELECT con la BBDD
    $partnerRepositorio = new PartnersRepositorio();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $nombre = trim(htmlspecialchars($_POST['nombre']));
        $descripcion = trim(htmlspecialchars($_POST['descripcion']));

        $tiposAceptados = ['image/jpeg', 'image/jpg', 'image/gif', 'image/png',];

        //Crea el fichero, lo guarda en la galería y lo copia en el directorio 'portfolio'
        $logo = new File('logo', $tiposAceptados);
        $logo->saveUploadFile(ImagenGaleria::rutaImagenesGallery);
        $logo->copyFile(ImagenGaleria::rutaImagenesGallery, ImagenGaleria::rutaImagenesPortfolio);

        //Sentencias SQL de tipo INSERT
        $partner = new Partners($nombre, $logo->getFileName(), $descripcion);
        $partnerRepositorio->save($partner);
        $mensaje = 'Logo guardado';
    }
} catch (FileException $exception) {
    $errores[] = $exception->getMessage();
} catch (QueryException $exception) {
    $errores[] = $exception->getMessage();
} catch (AppException $exception) {
    $errores[] = $exception->getMessage();
} catch (PDOException $exception) {
    $errores[] = $exception->getMessage();
} finally {
    $partners = $partnerRepositorio->findAll();
}

require_once 'views/partners.views.php';
