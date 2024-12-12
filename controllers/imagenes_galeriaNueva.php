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


    $descripcion = '';
    $mensaje = '';
    
    try {
        //Acceso al archivo de configuración de la base de datos
        $config = require_once 'app/config.php';

        //Guardamos la configuración en el contenedor de servicios:
        App::bind('config',$config);

        $imagenRepository = new ImagenGaleriaRepositorio();
        $categoriaRepositorio = new CategoriaRepositorio();

        //$queryBuilder = new QueryBuilder('imagenes','ImagenGaleria');
        
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            
                // COn trim se limpia el formulario para evitar errores cuando se incluya otro archivo.
                $descripcion = trim(htmlspecialchars($_POST['descripcion']));
                $categoria = trim(htmlspecialchars($_POST['categoria']));
                $tiposAceptados = ['image/jpeg','image/jpg','image/gif','image/png'];
                //Procesa la imagen subida, la guarda y copia en las rutas correspondientes.
                $imagen = new entities\File('imagen',$tiposAceptados);
                $imagen -> saveUploadFile(entities\ImagenGaleria::rutaImagenesGallery);
                $imagen -> copyFile(entities\ImagenGaleria::rutaImagenesGallery,entities\ImagenGaleria::rutaImagenesPortfolio);
                //Crea el objeto imagen que representa el archivo subido y lo guarda.
                $imagenGaleria = new entities\ImagenGaleria($imagen->getFileName(), $descripcion, $categoria);
                $imagenRepository->save($imagenGaleria);
                $descripcion = "";
                $mensaje = 'Imagen guardada';
            } 
     
    }
    catch (FileException $exception) {
            $errores[] = $exception->getMessage();
    }catch (QueryException $exception) {
        $errores[] = $exception->getMessage();
    }catch (AppException $exception){
        $errores[] = $exception->getMessage();
    }catch(PDOException $exception){
        $errores[] = $exception->getMessage();
    }
    finally{ 
        
        $imagenes = $imagenRepository->findAll();
        $categorias = $categoriaRepositorio->findAll();
    }
    require 'views/galeria.view.php';
?>