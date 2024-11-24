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

$numeroDePartners = count($partners); // Obtener la cantidad de asociados

// Si hay más de 3 asociados, seleccionamos tres de forma aleatoria
if ($numeroDePartners > 3) {
    // Selección aleatoria de tres asociados
    $keysAleatorias = array_rand($partners, 3); // Obtiene 3 claves aleatorias
    
    // Si array_rand devuelve un solo valor (si se usa 1 en lugar de 3), aseguramos que sea un array
    if (!is_array($keysAleatorias)) {
        $keysAleatorias = [$keysAleatorias];
    }
    
    // Creamos un array solo con los tres asociados seleccionados
    $partners = array_map(function($key) use ($partners) {
        return $partners[$key];
    }, $keysAleatorias);
}

require_once "views/index.views.php";
