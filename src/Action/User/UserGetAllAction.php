<?php

namespace App\Action\User;

use App\Domain\User\Service\UserReader;
use Psr\Http\Message\ResponseInterface as Response;

class UserGetAllAction extends UserAction
{
    private $userReader;

    public function __construct(UserReader $userReader)
    {
        $this->userReader = $userReader;
    }

    protected function action(): Response
	{
		return $this->respondWithData($this->userReader->readUsers(), 200);
	}
}