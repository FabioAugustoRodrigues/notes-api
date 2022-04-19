<?php

namespace App\Action\User;

use App\Domain\User\Assembler\UserAssembler;
use App\Domain\User\Service\UserReader;
use Psr\Http\Message\ResponseInterface as Response;

class UserGetByIdAction extends UserAction
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
        $id = $this->request->getAttribute("id");
		return $this->respondWithData($this->userAssembler->userToArray($this->userReader->readById($id)), 200);
	}
}