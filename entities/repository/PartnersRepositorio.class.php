<?php
require_once 'entities/QueryBuilder.class.php';

class PartnersRepositorio extends QueryBuilder{
    public function __construct(string $table='asociados',string $classEntity='Partners')
    {
        parent::__construct($table, $classEntity);
        
    }
}

?>