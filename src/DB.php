<?php namespace Todo;

use PDO;
use PDOStatement;

class DB
{
    private ?PDO $connection = null;

    public function __construct()
    {
        $this->connection = new PDO(
            'mysql:host='. $_ENV['DB_HOST'] .';dbname='. $_ENV['DB_TABLE'],
            $_ENV['DB_USER'],
            $_ENV['DB_PASSWORD'],
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            ]
        );
    }

    public function query(string $query, array $parameters = []): bool|PDOStatement
    {
        if (empty($parameters)) {
            return $this->connection->query($query);
        }

        $statement = $this->connection->prepare($query);
        $statement->execute($parameters);

        return $statement;
    }

    public function getConnection()
    {
        return $this->connection;
    }

    public function lastInsertId()
    {
        return $this->connection->lastInsertId();
    }
}