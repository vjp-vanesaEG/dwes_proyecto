<?php

namespace proyecto\entities;
use Exception;

class Router{

private $routes;

private function __construct(){
    $this->routes =[
        'GET' => [],
        'POST' => []
    ];
}

public static function load(string $file): Router{
    $router =new Router();
    require $file;
    return $router;
}    


public function get(array $controller): void{  //array para guardar la tabla de rutas
        $this->routes['GET']= $controller;
}

public function post(string $Uri, string $controller): void{  //array para guardar la tabla de rutas
    $this->routes['POST'][$Uri]= $controller;
}

public function direct(string $Uri, string $method):string{
    if(array_key_exists($Uri, $this->routes[$method])){
        return $this->routes[$method][$Uri];
    }else{
        throw new Exception("No se ha definido una ruta para la Uri solicitada");
        
    }
}

}


?>