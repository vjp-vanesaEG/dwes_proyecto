<?php
    require_once 'entities/database/IEntity.class.php';
    Class ImagenGaleria implements IEntity{

        const rutaImagenesPortfolio = 'images/index/portfolio/';
        const rutaImagenesGallery = 'images/index/gallery/';

        private $nombre;
        private $descripcion;
        private $numVisualizaciones;
        private $numLikes;
        private $numDescargas;
        private $id;
        private $categoria;

        public function __construct(string $nombre ='', string $descripcion ='',int $categoria=0, int $numVisualizaciones=0, int $numLikes=0, int $numDescargas=0)
        {
            $this->nombre = $nombre;
            $this->descripcion = $descripcion;
            $this->numVisualizaciones = $numVisualizaciones;
            $this->numLikes = $numLikes;
            $this->numDescargas = $numDescargas;
            $this->id=null;
            $this->categoria=$categoria;
        }

        public function getNombre() : string{
            return $this->nombre;
        }

        public function getId() {
            return $this->id;
        }
        public function setNombre(string $nombre) : void{
            $this->nombre = $nombre;
        }

        public function getDescripcion() : string{
            return $this->descripcion;
        }

        public function setDescripcion(string $descripcion) : void{
            $this->descripcion = $descripcion;
        }

        
        public function getNumVisualizaciones() : int{
            return $this->numVisualizaciones;
        }

        public function setNumVisualizaciones(int $numVisualizaciones) : void{
            $this->numVisualizaciones = $numVisualizaciones;
        }

        
        public function getNumLike() : int{
            return $this->numLikes;
        }

        public function setNumLike(int $numLikes) : void{
            $this->numLikes = $numLikes;
        }

        
        public function getNumDescargas() : int{
            return $this->numDescargas;
        }

        public function setNumDescargas(int $numDescargas) : void{
            $this->numDescargas = $numDescargas;
        }

        public function getUrlPortfolio():string{
            return self::rutaImagenesPortfolio.$this->getNombre();
        }

        public function getUrlGallery():string{
            return self::rutaImagenesGallery.$this->getNombre();
        }

        public function getCategoria(){
            return $this->categoria;
        }

        public function setCategoria(string $categoria){
            $this->categoria = $categoria;
        }

        public function toArray(): array
        {
          return [ 'id' => $this->getId(),
           'nombre' => $this->getNombre(), 
           'descripcion' => $this->getDescripcion(), 
           'numVisualizaciones' => $this->getNumVisualizaciones(), 
           'numLikes' => $this->getNumLike(), 
           'numDescargas' => $this->getNumDescargas(),
           'categoria' => $this->getCategoria()
        ]; 
        }
    }

?>