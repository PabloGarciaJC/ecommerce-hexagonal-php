<?php
namespace Domain\Entity;
class Favorite {
    private ?int $id;
    private int $productId;
    private int $userId;
    public function __construct(int $productId, int $userId, ?int $id = null) {
        $this->id = $id;
        $this->productId = $productId;
        $this->userId = $userId;
    }
    public function getId(): ?int { return $this->id; }
    public function getProductId(): int { return $this->productId; }
    public function getUserId(): int { return $this->userId; }
}
