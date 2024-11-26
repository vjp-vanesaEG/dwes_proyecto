<?php

require_once 'entities/App.class.php';
require_once 'exceptions/AppException.class.php';

class Connection
{
    //Creación de la conexión a la BBDD a través del método make

    public static function make()
    {

        try {
            $config = App::get('config')['database']; //Esta línea de código accede al contenedor de dependencias App, obtiene la configuración almacenada bajo la clave 'config', y luego extrae el sub-array asociado con la clave 'database' para trabajar con los parámetros de la base de datos.
            $connection = new PDO(
                $config['connection']. ';dbname='.$config['name'],
                $config['username'],
                $config['password'],
                $config['options']
);
        } catch (PDOException) {
            throw new AppException(getErrorString(ERROR_CON_BBDD));
        }

        return $connection;
    }
}
?>