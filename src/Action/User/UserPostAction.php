<?php

namespace App\Action\User;

use App\Action\User\UserAction;
use App\Domain\User\Service\UserCreator;
use Psr\Http\Message\ResponseInterface as Response;

class UserPostAction extends UserAction
{
    private $userCreator;

    public function __construct(UserCreator $userCreator)
    {
        $this->userCreator = $userCreator;
    }

    protected function action(): Response
	{
        $data = (array)$this->request->getParsedBody();

        $userId = $this->userCreator->createUser($data);

        $result = [
            'user_id' => $userId
        ];

        return $this->respondWithData($result, 201);

	}
}