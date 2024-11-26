<?php
require_once 'exceptions/QueryException.class.php';
require_once 'utils/strings.php';
require_once 'entities/App.class.php';
require_once 'entities/Categoria.class.php';

abstract class QueryBuilder
{

    private $connection;
    private $table;
    private $classEntity;

    // Le pasamos el nombre de la tabla y la clase de la que queremos obtener los datos.
    public function __construct($table, $classEntity)
    {
        $this->connection = App::getConnection();   // Obtiene la conexión a la BBDD desde la clase App.
        $this->table = $table;
        $this->classEntity = $classEntity;
    }

    // Recupera todos los registros de una tabla en una base de datos.
    public function findAll()
    {

        $sqlStatement = "Select * from $this->table";
        $pdoStatement = $this->connection->prepare($sqlStatement);

        if ($pdoStatement->execute() === false) {

            throw new QueryException(getErrorString(ERROR_EXECUTE_STATEMENT));
        }
        return $pdoStatement->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, $this->classEntity); //Recupera todos los resultados de la consulta.(array asociativo)
        //PDO::FETCH_CLASS: Crea objetos de la clase indicada para cada fila.
        //PDO::FETCH_PROPS_LATE: Primero llama al constructor de la clase, luego asigna los valores.
    }

    //Inicia una transacción SQL para que todos los cambios realizados en este bloque se apliquen juntos (en caso de éxito) o se deshagan (en caso de error).
    public function incrementaNumCategoria(int $categoria)
    {
        try {
            $this->connection->beginTransaction();
            $sql = "UPDATE categorias SET numImagenes=numImagenes+1 WHERE id=$categoria";
            $this->connection->exec($sql);
            $this->connection->commit(); //guarda los cambios de manera permanente si todo se ejecuta correctamente.
        } catch (Exception $exception) {
            throw new Exception(($exception->getMessage()));
            $this->connection->rollBack();
        }
    }

    //Función que inserta un registro en la base de datos usando los datos de la entidad que recibe
    public function save(IEntity $entity): void
    {
        try {
            $parameters = $entity->toArray();


            // insert into imagenes (descripcion, categoria) values (bytes, 1)
            $sql = sprintf(
                'insert into %s (%s) values (%s)',
                $this->table,
                implode(', ', array_keys($parameters)),
                ':' . implode(',:', array_keys($parameters))
            );
            $statement = $this->connection->prepare($sql);
            $statement->execute($parameters);

            if ($entity instanceof ImagenGaleria) {
                $this->incrementaNumCategoria($entity->getCategoria()); //Contabiliza el nº de imagenes pertenecientes a cada categoría.
            }
        } catch (PDOException $exception) {
            // throw new QueryException(ERROR_STRINGS[ERROR_INSERT_BD]);
            die($exception->getMessage());
        }
    }
}
