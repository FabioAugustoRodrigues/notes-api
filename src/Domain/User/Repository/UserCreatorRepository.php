<?php

namespace App\Domain\User\Repository;

use PDO;

final class UserCreatorRepository
{
    private $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function insertUser(array $user): int
    {
        $row = [
            'name' => $user['name'],
            'email' => $user['email'],
            'password' => $user['password'],
            'status' => $user['status']
        ];

        $sql = "INSERT INTO user SET 
                name=:name, 
                email=:email, 
                password=:password, 
                status=:status;";

        $this->connection->prepare($sql)->execute($row);

        return (int)$this->connection->lastInsertId();
    }
}