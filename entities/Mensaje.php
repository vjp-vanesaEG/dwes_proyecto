<?php
//require_once 'entities/database/IEntity.class.php';

namespace proyecto\entities;
use IEntity;
use DateTime;
class Mensaje implements IEntity
{
        private $id;
        private $nombre;
        private $apellidos;
        private $asunto;
        private $email;
        private $texto;
        private $fecha;

        public function __construct($nombre = '', $apellidos = '', $asunto = '', $email = '', $texto = '')
        {
                $this->nombre = $nombre;
                $this->apellidos = $apellidos;
                $this->asunto = $asunto;
                $this->email = $email;
                $this->texto = $texto;
                $this->fecha = new DateTime("Y-m-d H:i:s");
                $this->id = null;
        }

        public function getNombre()
        {
                return $this->nombre;
        }

        public function setNombre($nombre)
        {
                $this->nombre = $nombre;

                return $this;
        }

        public function getApellidos()
        {
                return $this->apellidos;
        }

        public function setApellidos($apellidos)
        {
                $this->apellidos = $apellidos;

                return $this;
        }

        public function getAsunto()
        {
                return $this->asunto;
        }

        public function setAsunto($asunto)
        {
                $this->asunto = $asunto;

                return $this;
        }

        public function getEmail()
        {
                return $this->email;
        }

        public function setEmail($email)
        {
                $this->email = $email;

                return $this;
        }

        public function getTexto()
        {
                return $this->texto;
        }

        public function setTexto($texto)
        {
                $this->texto = $texto;

                return $this;
        }

        public function getFecha()
        {
                return $this->fecha;
        }

        public function setFecha($fecha)
        {
                $this->fecha = $fecha;

                return $this;
        }

        public function getId()
        {
                return $this->id;
        }

        public function setId($id)
        {
                $this->id = $id;

                return $this;
        }

        public function toArray(): array
        {
                return [
                        'nombre' => $this->getNombre(),
                        'apellidos' => $this->getApellidos(),
                        'asunto' => $this->getAsunto(),
                        'email' => $this->getEmail(),
                        'texto' => $this->getTexto(),
                        'fecha' => $this->getFecha()
                ];
        }
}
