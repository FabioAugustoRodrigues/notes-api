<?php

namespace App\Domain\User\Assembler;

use App\Domain\User\User;

final class UserAssembler
{
    
    public function userToArray(User $user){
        return [
            "name" => $user->getName(),
            "email" => $user->getEmail(),
            "status" => $user->getStatus()
        ];
    }

}