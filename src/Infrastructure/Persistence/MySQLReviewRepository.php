<?php
namespace Infrastructure\Persistence;
use Domain\Repository\ReviewRepositoryInterface;
use Domain\Entity\Review;
use PDO;
class MySQLReviewRepository implements ReviewRepositoryInterface {
    private PDO $connection;
    public function __construct(PDO $connection) { $this->connection = $connection; }
    public function save(Review $review): void {
        $stmt = $this->connection->prepare('INSERT INTO reviews (product_id, user_id, rating, comment, created_at) VALUES (:product_id, :user_id, :rating, :comment, :created_at)');
        $stmt->execute([
            ':product_id' => $review->getProductId(),
            ':user_id' => $review->getUserId(),
            ':rating' => $review->getRating(),
            ':comment' => $review->getComment(),
            ':created_at' => $review->getCreatedAt()->format('Y-m-d H:i:s')
        ]);
    }
    public function findByProductId(int $productId): array {
        $stmt = $this->connection->prepare('SELECT * FROM reviews WHERE product_id = :product_id ORDER BY created_at DESC');
        $stmt->execute([':product_id' => $productId]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $reviews = [];
        foreach ($rows as $r) {
            $reviews[] = new Review($r['product_id'], $r['user_id'], $r['rating'], $r['comment'], (int)$r['id'], new \DateTimeImmutable($r['created_at']));
        }
        return $reviews;
    }
    public function findByUserId(int $userId): array {
        $stmt = $this->connection->prepare('SELECT * FROM reviews WHERE user_id = :user_id ORDER BY created_at DESC');
        $stmt->execute([':user_id' => $userId]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $reviews = [];
        foreach ($rows as $r) {
            $reviews[] = new Review($r['product_id'], $r['user_id'], $r['rating'], $r['comment'], (int)$r['id'], new \DateTimeImmutable($r['created_at']));
        }
        return $reviews;
    }
    public function delete(int $id): void {
        $stmt = $this->connection->prepare('DELETE FROM reviews WHERE id = :id');
        $stmt->execute([':id' => $id]);
    }
}
