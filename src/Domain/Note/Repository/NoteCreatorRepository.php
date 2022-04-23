<?php

namespace App\Domain\Note\Repository;

use PDO;

final class NoteCreatorRepository
{
    private $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function insertNote(array $note): int
    {
        $row = [
            'id_user' => $note['id_user'],
            'title' => $note['title'],
            'content' => $note['content']
        ];

        $sql = "INSERT INTO note (id_user, title, content) VALUES (:id_user, :title, :content)";

        $this->connection->prepare($sql)->execute($row);

        return (int)$this->connection->lastInsertId();
    }
}