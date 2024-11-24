<?php
require_once "utils/utils.php";
require_once "entities/ImagenGaleria.class.php";
require_once 'entities/Partners.class.php';
require_once 'entities/Connection.class.php';
require_once 'entities/repository/ImagenGaleriaRepositorio.class.php';

// Inicializazamos un array vacío para almacenar los objetos de tipo ImagenGaleria
$imagenes = [];

// Bucle para generar 12 objetos de la clase ImagenGaleria
for ($i = 1; $i <= 12; $i++) {

    // Crear un nuevo objeto ImagenGaleria
    $imagen = new ImagenGaleria(
        $i . '.jpg',                      // Nombre de la imagen
        'descripcion imagen ' . $i,       // Descripción imagen
        rand(100, 1000),                   // Número aleatorio de visualizaciones entre 100 y 1000
        rand(50, 500),                    // Número aleatorio de descargas entre 50 y 500
        rand(10, 100)                    // Número aleatorio de likes entre 10 y 100
    );

    // Añadir el objeto al array de imágenes
    $imagenes[] = $imagen;
}

// Barajamos las imágenes para que su orden sea aleatorio
shuffle($imagenes);

// Imprimimos el array de objetos (para probar)
// echo '<pre>';
// print_r($imagenes);
// echo '</pre>';

require_once "views/index.views.php";
