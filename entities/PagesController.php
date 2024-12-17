<?php

namespace proyecto\entities;

use CategoriaRepositorio;
use ImagenGaleriaRepositorio;

class PagesController{
    public function index(){
        $imagenRepositorio = new ImagenGaleriaRepositorio();
        $imagenes = $imagenRepositorio->findAll();
        $categoriaRepositorio = new CategoriaRepositorio();
        $categorias = $categoriaRepositorio->findAll();


    }
}

require_once '../views/index.views.php';




?>