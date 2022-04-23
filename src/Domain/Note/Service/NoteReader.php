<?php

namespace App\Domain\Note\Service;

use App\Domain\Note\Note;
use App\Domain\Note\Repository\NoteReaderRepository;

final class NoteReader
{
    private $repository;

    public function __construct(NoteReaderRepository $repository)
    {
        $this->repository = $repository;
    }

    public function readAllNotesByUser(int $id_user): array
    {
        return $this->repository->readAllNotesByUser($id_user);
    }

    public function readById($id): Note
    {
        $noteArray = $this->repository->readById($id);
        return new Note($noteArray["id"], $noteArray["id_user"], $noteArray["title"], $noteArray["content"]);
    }
}