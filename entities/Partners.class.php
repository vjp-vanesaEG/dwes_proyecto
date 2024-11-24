<?php

require_once 'database/IEntity.class.php';

class Partners implements IEntity {
    //Consante
    const RUTA_IMAGENES_GALLERY = 'images/index/gallery/';
    //Variables
    private $nombre;
    private $logo;
    private $descripcion;
    private $id;


    //Constructor
    public function __construct($nombre = '', $logo = '', $descripcion = '') {
        $this->nombre = $nombre;
        $this->logo = $logo;
        $this->descripcion = $descripcion;
    }

    public function toArray(): array{
        return [
            'nombre' => $this->nombre,
            'logo' => $this->logo,
            'descripcion' => $this->descripcion
        ];
    }


    public function getUrlLogo() {
        return self::RUTA_IMAGENES_GALLERY . $this->logo;
    }

    //Getters
    public function getId() {
        return $this->id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getLogo() {
        return $this->logo;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }
}