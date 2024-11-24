<?php
require_once 'entities/database/IEntity.class.php';

//Todas las clases que implementen la interfaz tienen que usar el método toArray que devolverá sus atributos a través de los getters.

class ImagenGaleria implements IEntity
{
    // Definimos las rutas de las imágenes de portfolio y galería

    const rutaImagenesPortfolio = 'images/index/porfolio/';
    const rutaImagenesGallery = 'images/index/gallery/';

    private $nombre;
    private $descripcion;
    private $numVisualizaciones;
    private $numLikes;
    private $numDescargas;
    private $id;
    private $categoria;

    public function __construct(string $nombre = '', string $descripcion = '', int $categoria = 0, int $numVisualizaciones = 0, int $numLikes = 0, int $numDescargas = 0)
    {
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->numVisualizaciones = $numVisualizaciones;
        $this->numLikes = $numLikes;
        $this->numDescargas = $numDescargas;
        $this->id = null;
        $this->categoria = $categoria;
    }

    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): void
    {
        $this->nombre = $nombre;
    }

    public function getDescripcion(): string
    {
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): void
    {
        $this->descripcion = $descripcion;
    }

    public function getNumVisualizaciones(): int
    {
        return $this->numVisualizaciones;
    }

    public function setNumVisualizaciones(int $numVisualizaciones): void
    {
        $this->numVisualizaciones = $numVisualizaciones;
    }

    public function getNumLikes(): int
    {
        return $this->numLikes;
    }

    public function setNumLikes(int $numLikes): void
    {
        $this->numLikes = $numLikes;
    }

    public function getNumDescargas(): int
    {
        return $this->numDescargas;
    }

    public function setNumDescargas(int $numDescargas): void
    {
        $this->numDescargas = $numDescargas;
    }

    public function getUrlPortfolio(): string
    {
        return self::rutaImagenesPortfolio . $this->getNombre();
    }

    public function getUrlGallery(): string
    {
        return self::rutaImagenesGallery . $this->getNombre();
    }

    public function getCategoria()
    {
        return $this->categoria;
    }

    public function setCategoria(string $categoria)
    {
        $this->categoria = $categoria;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    //Array asociativo que muestra todas las propiedades de la clase (clave,valor).

    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'nombre' => $this->getNombre(),
            'descripcion' => $this->getDescripcion(),
            'numVisualizaciones' => $this->getNumVisualizaciones(),
            'numLikes' => $this->getNumLikes(),
            'numDescargas' => $this->getNumDescargas(),
            'categoria' => $this->getCategoria()
        ];
    }
}
