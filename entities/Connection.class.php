<?php

require_once 'entities/App.class.php';
require_once 'utils/strings.php';
class Connection
{

    public static function make()
    {

        try {
            $config = App::get('config')['database'];
            $connection = new PDO(
                $config['connection']. ';dbname='.$config['name'],
                $config['username'],
                $config['password'],
                $config['options']
);
        } catch (PDOException $PDOException) {
            throw new AppException(getErrorString(ERROR_CON_BBDD));
        }

        return $connection;
    }
}
?>