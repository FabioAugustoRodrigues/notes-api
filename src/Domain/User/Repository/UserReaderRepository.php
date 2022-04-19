<?php

namespace App\Domain\User\Repository;

use DomainException;
use PDO;

final class UserReaderRepository
{
    private $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function readAllUsers(): array
    {
        $sql = "SELECT * FROM user";
        $statement = $this->connection->prepare($sql);
        $statement->execute();

        $result = $statement->fetchAll();

        if (!$result) {
            throw new DomainException(sprintf('Users not found'));
        }

        return $result;
    }

    public function readById($id): array
    {
        $row = [
            'id' => $id
        ];

        $sql = "SELECT * FROM user WHERE id = :id";
        $statement = $this->connection->prepare($sql);
        $statement->execute($row);

        $result = $statement->fetch();

        if (!$result) {
            throw new DomainException(sprintf('User not found'));
        }

        return $result;
    }
}