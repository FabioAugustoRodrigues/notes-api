<?php

namespace App\Domain\Note\Service;

use App\Domain\Note\Repository\NoteCreatorRepository;
use App\Domain\User\Repository\UserReaderRepository;
use App\Exception\ValidateException;

final class NoteCreator
{
    private $noteCreatorRepository;
    private $userReaderRepository;

    public function __construct(NoteCreatorRepository $noteCreatorRepository, UserReaderRepository $userReaderRepository)
    {
        $this->noteCreatorRepository = $noteCreatorRepository;
        $this->userReaderRepository = $userReaderRepository;
    }

    public function createNote(array $data): int
    {
        $this->validateNewNote($data);
        $user = $this->userReaderRepository->readById($data["id_user"]);

        $noteId = $this->noteCreatorRepository->insertNote($data);

        return $noteId;
    }

    private function validateNewNote(array $data): void
    {
        $errors = [];

        if (empty($data['title'])) {
            $errors['title'] = 'Input required';
        }

        if (empty($data['content'])) {
            $errors['content'] = 'Input required';
        } 

        if ($errors) {
            throw new ValidateException('Please check your input', $errors);
        }
    }
}