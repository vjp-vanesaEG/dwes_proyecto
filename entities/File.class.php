<?php
require __DIR__.'/../exceptions/FileException.class.php';
require 'utils/strings.php';
class File{
    private $file;
    private $fileName;

    public function __construct(string $fileName, array $arrTypes)
    {
        //con $fileName obtendremos el fichero mediante el array $_FILES que contiene
        //todos los ficheros que se suben al servidor mediante un formulario
        $this->file = $_FILES[$fileName];
        $this->fileName = '';

        //Comprobamos que ese array contiene el fichero
        if (!isset($this->file)) {
            //Mostrar un error
            throw new FileException(ERROR_STRINGS[UPLOAD_ERR_NO_FILE]);
        }

        //Comprobamos si el fichero subido es de un tipo de los quetenemos soportados
        if (in_array($this->file['type'], $arrTypes) === false) {
            //Error, tipo no soportado
            throw new FileException(ERROR_STRINGS[UPLOAD_ERR_EXTENSION]);
            
        }
    }

    public function getFileName()
    {
        return $this->fileName;
    }

    public function saveUploadFile(string $rutaDestino) {
        // Verifica que el archivo haya sido subido mediante una solicitud POST
        if (!is_uploaded_file($this->file['tmp_name'])) {
            throw new FileException('El archivo no se ha subido mediante el formulario');
        }
   
        // con pathinfo se puede separar el nombre de la extension
        $nombreBase = pathinfo($this->file['name'], PATHINFO_FILENAME);// Este sirve para extraer el nombre
        $extension = pathinfo($this->file['name'], PATHINFO_EXTENSION);// Este sirve para extraer la extension
       
     
        $contador = 1; // contado con el numero que tendra la imagen si se repite
        $ruta = $rutaDestino . $this->file['name'];//Ruta
   
        // Si el archivo ya existe en la ruta destino, genera un nombre nuevo agregando un sufijo numérico
        while (file_exists($ruta)) {
            $this->fileName = $nombreBase . "_$contador." . $extension;
            $ruta = $rutaDestino . $this->fileName;
            $contador++;
        }
        // si no esta duplicado usa el nombre original
        if ($contador === 1) {
            $this->fileName = $this->file['name'];
        }
   
        // Mueve el archivo subido a la ruta destino final
        if (!move_uploaded_file($this->file['tmp_name'], $ruta)) {
            throw new FileException(ERROR_STRINGS[ERROR_MV_UP_FILE]);
        }
    }


   
    public function copyFile (string $rutaOrigen,string $rutaDestino){
        $origen = $rutaOrigen . $this->fileName;
        $destino = $rutaDestino . $this->fileName;
        // Verifica que el archivo de origen exista
        if(is_file($origen)==false){
            throw new FileException("No existe el fichero $origen que intentas copiar");

        }
        // Verifica si el archivo de destino ya existe
        if(is_file($destino)==true){
            throw new FileException("El fichero $destino ya existe y no se puede sobreescribir");

        }
        // Copia el archivo de origen al destino
        if(copy($origen,$destino)==false){
            throw new FileException("No se ha podido copiar el fichero $origen a $destino");
        }
    }
   
}

