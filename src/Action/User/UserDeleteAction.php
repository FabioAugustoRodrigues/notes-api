<?php

namespace App\Action\User;

use App\Domain\User\Service\UserDelete;
use Psr\Http\Message\ResponseInterface as Response;

class UserDeleteAction extends UserAction
{
    private $userDelete;

    public function __construct(UserDelete $userDelete)
    {
        $this->userDelete = $userDelete;
    }

    protected function action(): Response
	{
        $id = $this->request->getAttribute("id");
        $this->userDelete->deleteUser($id);

		return $this->respondWithData("", 204);
	}
}