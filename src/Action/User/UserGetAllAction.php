<?php

namespace App\Action\User;

use App\Domain\User\Assembler\UserAssembler;
use App\Domain\User\Service\UserReader;
use App\Domain\User\User;
use Psr\Http\Message\ResponseInterface as Response;

class UserGetAllAction extends UserAction
{
    private $userReader;
    private $userAssembler;

    public function __construct(UserReader $userReader, UserAssembler $userAssembler)
    {
        $this->userReader = $userReader;
        $this->userAssembler = $userAssembler;
    }

    protected function action(): Response
	{
        $users = $this->userReader->readUsers();
        $usersArray = array();
        for ($i = 0; $i < count($users); $i++){
            $user = new User($users[$i]["id"], $users[$i]["name"], $users[$i]["email"], $users[$i]["password"], $users[$i]["status"]);
            array_push($usersArray, $this->userAssembler->userToArray($user));
        }

		return $this->respondWithData($usersArray, 200);
	}
}