<?php

namespace App\Domain\User\Assembler;

use App\Domain\User\User;

final class UserAssembler
{
    
    public function userToArray(User $user): array
    {
        return [
            "id" => $user->getId(),
            "name" => $user->getName(),
            "email" => $user->getEmail(),
            "status" => $user->getStatus()
        ];
    }

    public function arrayToUser(array $userArray): User
    {
        return new User($userArray["id"], $userArray["name"], $userArray["email"], $userArray["email"], $userArray["password"], $userArray["status"]);
    }

}