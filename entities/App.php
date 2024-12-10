<?php
// require_once 'exceptions/AppException.class.php';
// require_once 'utils/strings.php';

namespace proyecto\entities;
use AppException; 
use proyecto\utils;

//Clase que usará la Inyección de dependencias,es decir, pediremos los objetos que vayamos necesitando con esta implementación.
class App{

    //Donde se almacenarán los distintos objetos a los que queramos acceder.
private static $container=[];

//Va permitir almacenar un objeto dentro de nuestro contenedor a través de un clave.
public static function bind($clave,$valor){
    self::$container[$clave]=$valor;
}

//Va a devolver un elemento del array a partir de la clave que recibe.
public static function get(string $key){
    if(!array_key_exists($key,self::$container)){ //comprueba si la clave existe
        throw new AppException(utils\getErrorString(ERROR_APP_CORE));
    }
    return static::$container[$key];
}

//Devuelve una conexión a la base de datos, almacenándola en el contenedor si no existe previamente.
public static function getConnection(){
    if(!array_key_exists('connection', self::$container)){
        self::$container['connection']= Connection::make();
    }
    return static::$container['connection'];
}

}
?>