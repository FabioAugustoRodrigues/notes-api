<?php

namespace App\Domain\User\Service;

use App\Domain\User\Repository\UserDeleteRepository;
use Exception;

final class UserDelete
{
    private $repository;

    public function __construct(UserDeleteRepository $repository)
    {
        $this->repository = $repository;
    }

    public function deleteUser(int $id): bool
    {
        if (!$this->repository->deleteUser($id)){
            throw new Exception("There was an error deleting the user");
            return false;
        }

        return true;
    }
}