<?php

return ['database' =>
[
    'name' => 'proyecto',
    'username' => 'user',
    'password' => 'user',
    'connection' => 'mysql:host=localhost',
    'options' => [  // Aquí podremos añadir las opciones que veamos convenientes.
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8", // Asegura que se usa utf8 (codificación caracteres)
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Se lanzan excepciones si hay errores en la BBDD
        PDO::ATTR_PERSISTENT => true // Mantiene la solicitud activa (conexión activa)
    ]
]]
?>