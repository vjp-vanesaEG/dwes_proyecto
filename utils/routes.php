<?php

$router->get([

    ''=> '../controllers/index.php',
    'index' =>'../controllers/index.php',
    'about' => '../controllers/about.php',
    'contact' => '../controllers/contact.php',
    'partners' => '../controllers/partners.php',
    'blog' => '../controllers/blog.php',
    'galeria' => '../controllers/galeria.php',
    'single_post' => '../controllers/single_post.php'
]);

$router->post(

'imagenes_galeriaNueva' ,'../controllers/imagenes_galeriaNueva.php'
);

?>