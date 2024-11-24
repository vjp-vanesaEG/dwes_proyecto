<?php
require_once 'utils/strings.php';
require_once 'exceptions/QueryException.class.php';
require_once 'entities/imagenGaleria.class.php';
require_once 'entities/App.class.php';
require_once 'entities/Categoria.class.php';


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

    //Método que se conecta a la base de datos, ejecuta una consulta SQL para obtener todos los registros de una tabla específica y devuelve esos registros en forma de objetos.

    public function findAll(): array
    {
        // Definición de la consulta SQL
        $sqlStatement = "Select * from  $this->table";
        // Preparación de la consulta
        $pdoStatement = $this->connection->prepare($sqlStatement);
        // Ejecución de la consulta
        if ($pdoStatement->execute() === false) {
            throw new QueryException(ERROR_STRINGS[ERROR_EXECUTE_STATEMENT]);
        }
        // Recuperación de los resultados como objetos
        return $pdoStatement->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, $this->classEntities);
    }

    public function save(IEntity $entity): void
    {
        try {
        $parameters = $entity->toArray();

        $sql = sprintf(
            'insert into %s (%s) values (%s)',
            $this->table,
            implode(', ', array_keys($parameters)),
            ':' . implode(', :', array_keys($parameters))
        );

            $statement = $this->connection->prepare($sql);
            $statement->execute($parameters);
            if($entity instanceof ImagenGaleria){ //si es una imagen lo que estamos insertando en la tabla, incrementa el número de imágenes en la tabla correspondiente.
                $this-> incrementaNumCategorias($entity->getCategoria());
            }
        } catch (PDOException $exception) {
            throw new PDOException(getErrorString(ERROR_INS_BBDD));
            // throw new PDOException ($exception->getMessage());
        }
    }

    public function incrementaNumCategorias(int $categoria){
        try{
            $this->connection->beginTransaction();
            $sql = "UPDATE categorias SET numImagenes= numImagenes +1 WHERE id=$categoria";
            $this->connection->exec($sql);
            $this->connection->commit();
        }catch (Exception $exception){
            $this->connection->rollBack();
            throw new Exception($exception->getMessage());
        }
       

    }

}
