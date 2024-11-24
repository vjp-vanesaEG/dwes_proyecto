<?php
require_once 'entities/QueryBuilder.class.php';

class PartnersRepositorio extends QueryBuilder{
    public function __construct(string $table='asociados',string $classEntity='Partner')
    {
        parent::__construct($table, $classEntity);
        
    }
}

?>