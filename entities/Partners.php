<?php

//require_once 'database/IEntity.class.php';

namespace proyecto\entities;
use IEntity;
class Partners implements IEntity {

    //Definimos la ruta de galeria que es donde se encuentran los logos.
    const RUTA_IMAGENES_GALLERY = 'images/index/gallery/';

    private $nombre;
    private $logo;
    private $descripcion;
    private $id;

    public function __construct($nombre = '', $logo = '', $descripcion = '') {
        $this->nombre = $nombre;
        $this->logo = $logo;
        $this->descripcion = $descripcion;
    }

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

    public function getUrlLogo() {
        return self::RUTA_IMAGENES_GALLERY . $this->logo;
    }

    public function toArray(): array{
        return [
            'nombre' => $this->nombre,
            'logo' => $this->logo,
            'descripcion' => $this->descripcion
        ];
    }
}