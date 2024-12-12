<?php 
    // require_once 'utils/utils.php';
    // require_once 'entities/File.class.php';
    // require_once 'entities/ImagenGaleria.class.php';
    // require_once 'entities/Connection.class.php';
    // require_once 'entities/QueryBuilder.class.php';
    // require_once 'exceptions/AppException.class.php';
    // require_once 'exceptions/FileException.class.php';
    // require_once 'entities/repository/imagenGaleriaRepositorio.class.php';
    // require_once 'entities/repository/CategoriaRepositorio.class.php';

    use proyecto\entities;
    use proyecto\entities\FileException;
    use proyecto\entities\AppException;
    use proyecto\entities\QueryException;

    $errores = [];
    
    try {
       
        $imagenRepository = new ImagenGaleriaRepositorio();
        $categoriaRepository = new CategoriaRepositorio();

        //Aqui controlaremos todas los errores que puedan ocurrir que se encontrarán en la clase File definidos.
    }catch (FileException $exception) {
            $errores[] = $exception->getMessage();
    }catch (QueryException $exception) {
        $errores[] = $exception->getMessage();
    }catch (AppException $exception){
        $errores[] = $exception->getMessage();
    }catch(PDOException $exception){
        $errores[] = $exception->getMessage();
    }
   
    header('Location: /galeria');
?>