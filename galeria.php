<?php
require 'utils/ultis.php';
require 'entities/File.class.php';
require 'entities/Connection.class.php';

$errores = [];
$descripcion='';
$mensaje='';

if($_SERVER['REQUEST_METHOD']==='POST'){
    try{
        $descripcion = trim(htmlspecialchars($_POST['descripcion']));
        $tiposAceptados =['image/jpeg','image/jpg','image/gif','image/png'];
        $imagen = new File('imagen', $tiposAceptados);
        // $imagen->saveUploadedFile(imagenGaleria::rutaImagenesGallery);
        $connection = Connection::make();
        $sql = "INSERT INTO imagenes(nombre,descripcion) VALUES (:nombre, :descripcion)";
        $pdoStatement = $connection->prepare($sql);
        $parametersStatementArray = [':nombre'=>$imagen->getFileName(), ':descripcion'=>$descripcion];
        $respuesta = $pdoStatement->execute($parametersStatementArray);
        if($respuesta === false){
            $errores[] = 'No se ha podido guardar la imagen en la base de datos';
        }else{
            $descripcion ='';
            $mensaje ='imagen guardada';
        }
        $querySql = 'Select * from imagenes';
        $queryStatement = $connection -> query($querySql);
        while($row = $queryStatement->fetch()){
            //row =['id'->1,'nombre->'', 'descipcion->''']
            echo 'Nombre : ' + $row ['nombre'];
            echo 'Descripcion :' +$row['descripcion'];
        }
    }catch(FileException $exception){
        $errores[]= $exception->getMessage();

    }
   
}

require 'views/galeria.view.php';


?>