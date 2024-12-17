<?php

namespace Core;

use PDO;

class DataBase
{
    private PDO $connection;

    public function __construct()
    {
        try {
            $dsn = sprintf(
                'mysql:host=%s;port=%s;dbname=%s;charset=utf8mb4',
                DB_SETTINGS['host'],
                DB_SETTINGS['port'],
                DB_SETTINGS['database']
            );
            $this->connection = new PDO($dsn, DB_SETTINGS['username'], DB_SETTINGS['password']);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (\Exception $e) {
            echo "DB connection error:" . $e->getMessage();
        }
    }

    public function getConnection(): PDO
    {
        return $this->connection;
    }
}
