<?php

namespace Application\UseCase;

use Domain\Repository\UserRepositoryInterface;
use Domain\Entity\User;

class UpdateUser
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Update user fields. If $password is null or empty, keep existing password hash.
     * Returns the updated User or null if user not found.
     */
    public function execute(int $id, string $name, string $email, ?string $password = null): ?User
    {
        $existing = $this->userRepository->findById($id);
        if (!$existing) {
            return null;
        }

        $passwordHash = $existing->getPasswordHash();
        if (!empty($password)) {
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        }

        $updated = new User($name, $email, $id, $existing->getCreatedAt(), $passwordHash);
        $this->userRepository->update($updated);
        return $updated;
    }
}
