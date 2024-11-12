<?php

    require_once 'entities/QueryBuilder.class.php';

    class CategoriaRepositorio extends QueryBuilder{

        public function __construct(string $table ='categorias', string $classEntities='categoria'){

            parent::__construct($table,$classEntities);
            
        }

    }


?>