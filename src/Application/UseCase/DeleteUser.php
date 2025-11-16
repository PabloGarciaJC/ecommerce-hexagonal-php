<?php

namespace Application\UseCase;

use Domain\Repository\UserRepositoryInterface;

class DeleteUser
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute(int $id): void
    {
        $this->userRepository->deleteById($id);
    }
}
