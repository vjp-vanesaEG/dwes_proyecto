<?php
require 'exceptions/AppException.class.php';

class App{

private static $container=[];

public static function bind($clave,$valor){
    static::$container[$clave]=$valor;
}

public static function get(string $key){
    if(!array_key_exists($key,static::$container)){
        throw new AppException(getErrorString(ERROR_APP_CORE));
    }
    return self::$container[$key];
}

public static function getConnection(){
    if(!array_key_exists('connection', self::$container)){
        self::$container['connection']= Connection::make();
    }
    return self::$container['connection'];
}






}
?>