<?php
//equire __DIR__.'/../exceptions/FileException.class.php';
//require_once 'utils/strings.php';

namespace proyecto\entities;
use FileException;

class File{
    private $file;
    private $fileName;

    public function __construct(string $fileName, array $arrTypes)
    {
        $this->file = $_FILES[$fileName];
        $this->fileName = '';

        // Verifica que se ha enviado un archivo, si no muestra el error.
        if (!isset($this->file)){
            throw new FileException('Debes selecionar un fichero');
        }
        //Verifica que no hubo errores durante la subida, si no muestra el error que corresponda.
        if ($this->file['error'] !== UPLOAD_ERR_OK){

            // switch ($this->file['error']) {
            //     case UPLOAD_ERR_INI_SIZE:
            //     case UPLOAD_ERR_FORM_SIZE:{
            //         throw new FileException('El fichero es demasiado grande');
            //         break;
            //     }
            //     case UPLOAD_ERR_PARTIAL:{
            //         throw new FileException('No se ha poddo subir el fichero completo');
            //         break;
            //     }    
                
            //     default:{
            //         throw new FileException('No se ha podido subir el fichero');
            //         break;
            //     }
                    
            // }
            throw new FileException(ERROR_STRINGS[$this->file['error']]);
        }
        //Valida el tipo de archivo.
        if(in_array($this->file['type'],$arrTypes) === false){
            throw new FileException('Tipo de fichero no soportado');
        }
    }
    //Devuelve el nombre del archivo procesado.
    public function getFileName(){
        return $this->fileName;
    }

    //Guarda el archivo en el servidor si verifica que el archivo fue subido a través del formulario
    public function saveUploadFile(string $rutaDestino){
        if(is_uploaded_file($this->file['tmp_name']) === false){
            throw new FileException('El archivo no se ha subido mediante el formulario');
        }
        //Si ya existe un archivo con el mismo nombre en el directorio, agrega un contador para evitar sobrescribirlo
        $this->fileName = $this->file['name'];
        $ruta = $rutaDestino.$this->fileName;

        if(is_file($ruta)){
            $contador = 1;
            
            $cadena =  $this->fileName;
            while (is_file($ruta)) {
                    $this->fileName = "(" . $contador++ . ")" . $cadena;
                    $ruta = $rutaDestino.$this->fileName;    
            }
        }
        //Mueve el archivo a su destino final, si no muestra el error.
        if(move_uploaded_file($this->file['tmp_name'],$ruta) === false){
            throw new FileException("No se puede mover el fichero a su destino");
        }
    }
    //Copia el archivo a otro directorio
    public function copyFile(string $rutaOrigen, string $rutaDestio){
        $origen = $rutaOrigen . $this->fileName;
        $destino = $rutaDestio . $this->fileName;

            //Verifica que el archivo de origen existe.
        if(is_file($origen) === false){
            throw new FileException("No existe el fichero $origen que intentas copiar" );
        }
            //Evita sobrescribir archivos existentes en el destino.
        if(is_file($destino) === true){
            throw new FileException("El fichero $destino ya existe y no se puede sobreescribirlo" );
        }
            //Copia el archivo.
        if(copy($origen,$destino) === false){
            throw new FileException("No se ha podido copiar el fichero $origen a $destino" );
        }
    }
}
?>