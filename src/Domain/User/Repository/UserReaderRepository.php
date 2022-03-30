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

        $row = $statement->fetchAll();

        if (!$row) {
            throw new DomainException(sprintf('Users not found'));
        }

        return $row;
    }
}