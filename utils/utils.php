<?php

//Funciones para comprobar si la opción del menú está activa o no.

function esOpcionMenuActiva(string $opcionMenu): bool
{
    // Verifica si el nombre de la opción está en la ruta actual
    return strpos($_SERVER['PHP_SELF'], $opcionMenu) !== false;
}

//En este caso como es más de una opción, se comprueba con un array.

function existeOpcionMenuActivaEnArray(array $opciones): bool
{

    foreach ($opciones as $opcion) {
        if (esOpcionMenuActiva($opcion)) {
            return true;
        }
    }
    return false;
}

//Función para extraer 3 partners de un array.

// function extraerPartners(array $partners): array
// {
//     shuffle($partners);
//     return array_slice($partners, 0, 3);
// }

// Suponiendo que tienes una clase para manejar la conexión a la base de datos

function extraerPartners() {
    // Aquí deberías ejecutar la consulta a tu base de datos
    // Ejemplo usando PDO:
    $pdo = new PDO('mysql:host=localhost;dbname=proyecto', 'user', 'user');
    $stmt = $pdo->query("SELECT * FROM asociados");
    
    // Array para almacenar los objetos de partners
    $partners = [];
    
    // Obtener los resultados de la consulta y crear objetos Partners
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $partners[] = new Partners($row['nombre'], $row['logo'], $row['descripcion']);
    }

    return $partners;
}
