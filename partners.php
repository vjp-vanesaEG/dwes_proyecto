<?php

require 'utils/utils.php';
require_once 'entities/Partners.class.php';
require_once 'entities/repository/PartnersRepositorio.class.php';
require_once 'entities/File.class.php';
require_once 'entities/Connection.class.php';
require_once 'exceptions/AppException.class.php';
require_once 'exceptions/FileException.class.php';

$errores = [];
$descripcion = '';
$mensaje = '';

try {

    //Crea una conexión con la BBDD
    $config = require_once 'app/config.php';
    App::bind('config', $config);

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

require 'views/partners.views.php';