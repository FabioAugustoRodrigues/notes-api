<?php

namespace App\Action\User;

use App\Domain\User\Service\UserUpdate;
use Psr\Http\Message\ResponseInterface as Response;

class UserPatchNameAndEmailAction extends UserAction
{
    private $userUpdate;

    public function __construct(UserUpdate $userUpdate)
    {
        $this->userUpdate = $userUpdate;
    }

    protected function action(): Response
	{
        $data = (array)$this->request->getParsedBody();
        $id = $this->request->getAttribute("id");

        $this->userUpdate->updateNameAndEmail($id, $data);

		return $this->respondWithData("User updated successfully", 204);
	}
}