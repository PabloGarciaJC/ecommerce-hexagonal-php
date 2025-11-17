<?php
namespace Domain\Repository;
use Domain\Entity\Favorite;
interface FavoriteRepositoryInterface {
    public function save(Favorite $favorite): void;
    public function findByUserId(int $userId): array;
    public function delete(int $id): void;
}
