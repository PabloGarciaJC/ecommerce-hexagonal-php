<?php
namespace Domain\Repository;
use Domain\Entity\Review;
interface ReviewRepositoryInterface {
    public function save(Review $review): void;
    public function findByProductId(int $productId): array;
    public function findByUserId(int $userId): array;
    public function delete(int $id): void;
}
