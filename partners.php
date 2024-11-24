<?php
require_once 'utils/utils.php';
require_once 'entities/File.class.php';
require_once 'entities/Partners.class.php';
require_once 'entities/repository/PartnersRepositorio.class.php';
require_once 'entities/Connection.class.php';
require_once 'exceptions/AppException.class.php';
require_once 'exceptions/FileException.class.php';

$errores=[];
$descripcion='';
$mensaje='';

try{
    $config = require_once 'app/config.php';

    App::bind('config',$config);

    $partnerRepositorio= new PartnersRepositorio();

    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
        $nombre = trim(htmlspecialchars($_POST['nombre']));
        $descripcion = trim(htmlspecialchars($_POST['descripcion']));
        $tiposAceptados = ['image/jpeg', 'image/jpg', 'image/gif', 'image/png'];

        $logo= new File('logo',$tiposAceptados);

        $logo->saveUploadFile(Partners::RUTA_IMAGENES_GALERIA);

        $partner = new Partners($nombre,$logo->getFileName(),$descripcion);
        $partnerRepositorio->save($partner);
        $mensaje='Imagen logo guardada';


    }

}catch(FileException $exception) {
    $errores[] = $exception->getMessage();
    //guardo en un array los errores
}
finally{
    $asociados =  $partnerRepositorio->findAll();
}

require_once 'views/partners.views.php';
?>