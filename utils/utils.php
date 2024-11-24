<?php

//Funciones para comprobar si la opción del menú está activa o no.

function esOpcionMenuActiva(string $opcionMenu): bool
{
    // Verifica si el nombre de la opción está en la ruta actual
    return strpos($_SERVER['PHP_SELF'], $opcionMenu) !== false;
}

function existeOpcionMenuActivaEnArray(array $opciones): bool
{

    foreach ($opciones as $opcion) {
        if (esOpcionMenuActiva($opcion)) {
            return true;
        }
    }
    return false;
}

//Función para extraer 3 partners de un array y los devuelve

function extraerPartners(array $partners): array
{
    shuffle($partners);
    return array_slice($partners, 0, 3);
}
