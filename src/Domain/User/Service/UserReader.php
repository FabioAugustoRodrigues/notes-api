<?php

namespace App\Domain\User\Service;

use App\Domain\User\Assembler\UserAssembler;
use App\Domain\User\Repository\UserReaderRepository;
use App\Domain\User\User;
use App\Exception\ValidationException;

final class UserReader
{
    private $repository;

    private $assembler;

    public function __construct(UserReaderRepository $repository, UserAssembler $assembler)
    {
        $this->repository = $repository;
        $this->assembler = $assembler;
    }

    public function readUsers(): array
    {
        // Logging here: User created successfully
        //$this->logger->info(sprintf('User created successfully: %s', $userId));

        $users = $this->repository->readAllUsers();
        $usersArray = array();
        for ($i = 0; $i < count($users); $i++){
            $user = new User($users[$i]["id"], $users[$i]["name"], $users[$i]["email"], $users[$i]["password"], $users[$i]["status"]);
            array_push($usersArray, $this->assembler->userToArray($user));
        }

        return $usersArray;
    }
}