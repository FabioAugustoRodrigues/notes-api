<?php

namespace App\Domain\User\Service;

use App\Domain\User\Repository\UserCreatorRepository;
use App\Exception\ValidateException;

final class UserCreator
{
    private $repository;

    public function __construct(UserCreatorRepository $repository)
    {
        $this->repository = $repository;
    }

    public function createUser(array $data): int
    {
        $this->validateNewUser($data);

        $data['status'] = 'Active';
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

        $userId = $this->repository->insertUser($data);

        // Logging here: User created successfully
        //$this->logger->info(sprintf('User created successfully: %s', $userId));

        return $userId;
    }

    private function validateNewUser(array $data): void
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

        if (empty($data['password'])) {
            $errors['password'] = 'Input required';
        }

        if ($errors) {
            throw new ValidateException('Please check your input', $errors);
        }
    }
}