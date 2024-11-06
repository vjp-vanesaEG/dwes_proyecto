<?php
require_once 'utils/strings.php';
require_once 'exceptions/QueryException.class.php';
require_once 'entities/imagenGaleria.class.php';

class QueryBuilder{

    private $connection;

    /**
     * @var $connection;
     */
    public function __construct(PDO $connection){

        $this->connection = $connection;
    }

    public function findAll(string $table, string $classEntities){
        $sqlStatement = "Select * from $table";
        $pdoStatement = $this->connection->prepare($sqlStatement);

        if($pdoStatement->execute()===false){
            throw new QueryException(ERROR_STRINGS[ERROR_EXECUTE_STATEMENT]);
        }

        return $pdoStatement ->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, $classEntities);

    }




}
?>