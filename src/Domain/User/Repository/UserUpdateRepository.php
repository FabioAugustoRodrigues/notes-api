<?php

namespace App\Domain\User\Repository;

use PDO;

final class UserUpdateRepository
{
    private $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function updateNameAndEmail(array $user): bool
    {
        $row = [
            'name' => $user['name'],
            'email' => $user['email'],
            'id' => $user['id']
        ];

        $sql = "UPDATE user SET name = :name, email = :email WHERE id = :id";

        return $this->connection->prepare($sql)->execute($row) != 0;
    }
}