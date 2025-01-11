<?php

namespace App\Kernel\Database;

class Database implements DatabaseInterface
{
    private readonly \PDO $pdo;
    private readonly string $host;
    private readonly string $port;
    private readonly string $database;
    private readonly string $user;
    private readonly string $password;

    public function __construct()
    {
        $this->host = getenv('DB_HOST');
        $this->port = getenv('DB_PORT');
        $this->database = getenv('DB_DATABASE');
        $this->user = getenv('DB_USER');
        $this->password = getenv('DB_PASSWORD');
        $this->connect();
    }

    private function connect(): void
    {
        $dns = "pgsql:host=$this->host;port=$this->port;dbname=$this->database;";

        $opt = [
            // Для обработки исключений
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            // Возвращает результат запроса в виде ассоциативного массива, где ключами являются имена столбцов.
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            // Для чего-то
            \PDO::ATTR_EMULATE_PREPARES => false
        ];

        $this->pdo = new \PDO($dns, $this->user, $this->password, $opt);
    }

    public function disconnect(): void
    {
        $this->pdo = null;
    }

    public function insert(string $table, array $data): int
    {
        $fields = array_keys($data);

        $columns = implode(', ', $fields);
        $binds = implode(', ', array_map(fn ($field) => ":$field", $fields));

        $sql = "INSERT INTO $table ($columns) VALUES ($binds)";

        $stmt = $this->pdo->prepare($sql);

        try {
            $stmt->execute($data);
        } catch (\PDOException $exception) {
            throw $exception;
        }

        return (int) $this->pdo->lastInsertId();
    }

    public function first(string $table, array $conditions = [])
    {

    }

    public function existUserByEmail(string $email): bool
    {

        return true;
    }
}
