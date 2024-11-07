<?php

define('ERROR_MV_UP_FILE', 9);

define('ERROR_EXECUTE_STATEMENT', 10);
define('ERROR_APP_CORE',11);
define('ERROR_CON_BBDD',12);
define('ERROR_INS_BBDD',13);




$errorStrings[UPLOAD_ERR_OK] = "No hay ningún error";
$errorStrings[UPLOAD_ERR_INI_SIZE] = "El fichero es demasiado grande";
$errorStrings[UPLOAD_ERR_FORM_SIZE] = "El fichero es demasiado grande";
$errorStrings[UPLOAD_ERR_PARTIAL] = "No se ha podido subir el fichero";
$errorStrings[UPLOAD_ERR_NO_FILE] = "No se ha encontrado el archivo";
$errorStrings[UPLOAD_ERR_NO_TMP_DIR] = "No existe el directorio temporal";
$errorStrings[UPLOAD_ERR_CANT_WRITE] = "No se puede escribir";
$errorStrings[UPLOAD_ERR_EXTENSION] = "Error de extensión de archivo";
//Personalizados
$errorStrings[ERROR_MV_UP_FILE] = "No se ha podido mover el archivo al destino";
$errorStrings[ERROR_EXECUTE_STATEMENT] = "No se ha podido ejecutar la consulta";
$errorStrings[ERROR_APP_CORE] = "No se ha encontrado la clave en el contenedor";
$errorStrings[ERROR_CON_BBDD] = "No se ha podido crear la conexión con la base de datos";
$errorStrings[ERROR_INS_BBDD] = "No se ha podido hacer la insercción en la base de datos";



define('ERROR_STRINGS', $errorStrings);

function getErrorString($errorCode){
    return match(true){
        $errorCode=>ERROR_STRINGS[$errorCode]
    };
}