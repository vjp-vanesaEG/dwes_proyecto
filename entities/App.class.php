<?php
require_once 'exceptions/AppException.class.php';
require_once 'utils/strings.php';

class App{

    //Almacenará los distintos objetos de nuestro contenedor.
private static $container=[];

//Va permitir almacenar un objeto dentro de nuestro contenedor de servicios.
public static function bind($clave,$valor){
    self::$container[$clave]=$valor;
}

//Va a devolver un elemento del array a partir de la clave que recibe.
public static function get(string $key){
    if(!array_key_exists($key,self::$container)){
        throw new AppException(getErrorString(ERROR_APP_CORE));
    }
    return static::$container[$key];
}

public static function getConnection(){
    if(!array_key_exists('connection', self::$container)){
        self::$container['connection']= Connection::make();
    }
    return static::$container['connection'];
}

}
?>