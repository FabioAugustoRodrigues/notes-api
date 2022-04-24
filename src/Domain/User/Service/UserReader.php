<?php

namespace App\Domain\User\Service;

use App\Domain\User\Repository\UserReaderRepository;
use App\Domain\User\User;
use App\Exception\ValidationException;

final class UserReader
{
    private $repository;

    public function __construct(UserReaderRepository $repository)
    {
        $this->repository = $repository;
    }

    public function readUsers(): array
    {
        return $this->repository->readAllUsers();
    }

    public function readById($id): User
    {
        $userArray = $this->repository->readById($id);
        return new User($userArray["id"], $userArray["name"], $userArray["email"], $userArray["password"], $userArray["status"]);
    }

    public function readByEmail(string $email): User
    {
        $userArray = $this->repository->readByEmail($email);
        return new User($userArray["id"], $userArray["name"], $userArray["email"], $userArray["password"], $userArray["status"]);
    }
}