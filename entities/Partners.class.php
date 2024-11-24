<?php

require_once 'entities/database/IEntity.class.php';
require_once 'entities/QueryBuilder.class.php';
require_once 'partners.php';

class Partners implements IEntity {

    const RUTA_IMAGENES_GALERIA = 'images/index/gallery/';

    private $nombre;
    private $logo;
    private $descripcion;
    private $id;

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
        return self::RUTA_IMAGENES_GALERIA . $this->logo;
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
}