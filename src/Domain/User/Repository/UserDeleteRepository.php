<?php

namespace App\Domain\User\Repository;

use PDO;

final class UserDeleteRepository
{
    private $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function deleteUser(int $id): bool
    {
        $row = [
            'id' => $id
        ];

        $sql = "DELETE FROM user WHERE id = :id";

        return $this->connection->prepare($sql)->execute($row) != 0;
    }
}
