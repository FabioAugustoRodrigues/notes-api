<?php

namespace App\Action\User;

use App\Action\User\UserAction;
use App\Domain\User\Service\UserCreator;
use App\Domain\User\Service\UserReader;
use Psr\Http\Message\ResponseInterface as Response;
use Firebase\JWT\JWT;

class UserLoginAction extends UserAction
{
    private $userReader;

    public function __construct(UserReader $userReader)
    {
        $this->userReader = $userReader;
    }

    protected function action(): Response
	{
        $data = (array) $this->request->getParsedBody();

        $user = $this->userReader->readByEmail($data['email']);
        if (!password_verify($data['password'], $user->getPassword())) {
            return $this->respondWithData("Incorrect password", 203);
        }

        // $settings = $this->get('settings')['jwt']['secret'];
        $token = JWT::encode(['id' => $user->getId(), 'email' => $user->getEmail()], "supersecretkeyyoushouldnotcommittogithub", "HS256");

        return $this->respondWithData($token, 200);

	}
}