<?php

namespace App\Domain\Note\Repository;

use DomainException;
use PDO;

final class NoteReaderRepository
{
    private $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function readById($id): array
    {
        $row = [
            'id' => $id
        ];

        $sql = "SELECT * FROM note WHERE id = :id";
        $statement = $this->connection->prepare($sql);
        $statement->execute($row);

        $result = $statement->fetch();

        if (!$result) {
            throw new DomainException(sprintf('Note not found'));
        }

        return $result;
    }

    public function readAllNotesByUser($id_user): array
    {
        $row = [
            'id_user' => $id_user
        ];

        $sql = "SELECT * FROM note WHERE id_user = :id_user";
        $statement = $this->connection->prepare($sql);
        $statement->execute($row);

        $result = $statement->fetchAll();

        if (!$result) {
            throw new DomainException(sprintf('Notes not found'));
        }

        return $result;
    }
}