<?php

class Partner{
    //variables
    private string $nombre;
    private string $logo;
    private string $descripcion;

    //Constructor
    public function __construct(string $nombre, string $logo, string $descripcion)
    {
        $this->nombre = $nombre;
        $this->logo = $logo;
        $this->descripcion = $descripcion;
    }

    //Setters
	public function setNombre(string $nombre): void 
    {
        $this->nombre = $nombre;
    }

	public function setLogo(string $logo): void 
    {
        $this->logo = $logo;
    }

	public function setDescripcion(string $descripcion): void 
    {
        $this->descripcion = $descripcion;
    }

    //Getters
	public function getNombre(): string 
    {
        return $this->nombre;
    }

	public function getLogo(): string 
    {
        return $this->logo;
    }

	public function getDescripcion(): string 
    {
        return $this->descripcion;
    }
}
?>