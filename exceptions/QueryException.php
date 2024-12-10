<?php

namespace proyecto\entities;
use Exception;

class QueryException extends Exception{

    public function __construct(string $mensaje){
        parent::__construct($mensaje);
    }
}
