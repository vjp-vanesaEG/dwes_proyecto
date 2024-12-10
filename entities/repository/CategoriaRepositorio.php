<?php

    require_once 'entities/QueryBuilder.class.php';
    require_once 'entities/Categoria.class.php';

    class CategoriaRepositorio extends QueryBuilder{

        public function __construct(string $table ='categorias', string $classEntities='Categoria'){

            parent::__construct($table,$classEntities);
            
        }

    }


?>