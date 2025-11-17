<?php
namespace Infrastructure\Persistence;
use Domain\Repository\FavoriteRepositoryInterface;
use Domain\Entity\Favorite;
use PDO;
class MySQLFavoriteRepository implements FavoriteRepositoryInterface {
    private PDO $connection;
    public function __construct(PDO $connection) { $this->connection = $connection; }
    public function save(Favorite $favorite): void {
        $stmt = $this->connection->prepare('INSERT INTO favorites (product_id, user_id) VALUES (:product_id, :user_id)');
        $stmt->execute([
            ':product_id' => $favorite->getProductId(),
            ':user_id' => $favorite->getUserId()
        ]);
    }
    public function findByUserId(int $userId): array {
        $stmt = $this->connection->prepare('SELECT * FROM favorites WHERE user_id = :user_id');
        $stmt->execute([':user_id' => $userId]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $favorites = [];
        foreach ($rows as $r) {
            $favorites[] = new Favorite($r['product_id'], $r['user_id'], (int)$r['id']);
        }
        return $favorites;
    }
    public function delete(int $id): void {
        $stmt = $this->connection->prepare('DELETE FROM favorites WHERE id = :id');
        $stmt->execute([':id' => $id]);
    }
}
