<?php

namespace App\Domain\User\Service;

use App\Domain\User\Assembler\UserAssembler;
use App\Domain\User\Repository\UserReaderRepository;
use App\Domain\User\Repository\UserUpdateRepository;
use App\Exception\ValidateException;
use Exception;

final class UserUpdate
{
    private $updateRepository;
    private $readerRepository;
    private $assembler;

    public function __construct(UserUpdateRepository $updateRepository, UserReaderRepository $readerRepository, UserAssembler $assembler)
    {
        $this->updateRepository = $updateRepository;
        $this->readerRepository = $readerRepository;
        $this->assembler = $assembler;
    }

    public function updateNameAndEmail(int $id, array $data): bool
    {
        $this->validateUser($data);

        $user = $this->readerRepository->readById($id);
        $user["name"] = $data["name"];
        $user["email"] = $data["email"];

        if (!$this->updateRepository->updateNameAndEmail($user)){
            throw new Exception("There was an error updating the user");
            return false;
        }

        return true;
    }

    private function validateUser(array $data): void
    {
        $errors = [];

        if (empty($data['name'])) {
            $errors['name'] = 'Input required';
        }

        if (empty($data['email'])) {
            $errors['email'] = 'Input required';
        } else if (filter_var($data['email'], FILTER_VALIDATE_EMAIL) === false) {
            $errors['email'] = 'Invalid email address';
        }

        if ($errors) {
            throw new ValidateException('Please check your input', $errors);
        }
    }

}