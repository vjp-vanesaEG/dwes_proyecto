<?php
require_once 'utils/strings.php';
require_once 'exceptions/QueryException.class.php';
require_once 'entities/imagenGaleria.class.php';
require_once 'entities/App.class.php';

class QueryBuilder
{

    private $connection;
    private $table;
    private $classEntities;

    /**
     * @var $connection;
     */
    public function __construct(string $table, string $classEntities)
    {

        $this->connection = APP::getConnection();
        $this->table = $table;
        $this->classEntities = $classEntities;
    }

    public function findAll()
    {
        $sqlStatement = "Select * from  $this->table";
        $pdoStatement = $this->connection->prepare($sqlStatement);

        if ($pdoStatement->execute() === false) {
            throw new QueryException(ERROR_STRINGS[ERROR_EXECUTE_STATEMENT]);
        }

        return $pdoStatement->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, $this->classEntities);
    }

    public function save(IEntity $entity): void
    {
        $parameters = $entity->toArray();

        $sql = sprintf(
            'insert into %s (%s) values (%s)',
            $this->table,
            implode(', ', array_keys($parameters)),
            ':' . implode(', :', array_keys($parameters))
        );

        try {
            $statement = $this->connection->prepare($sql);
            $statement->execute($parameters);
        } catch (PDOException $exception) {
            throw new PDOException(getErrorString(ERROR_INS_BBDD));
        }
    }
}
