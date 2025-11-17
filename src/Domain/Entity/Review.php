<?php
namespace Domain\Entity;
class Review {
    private ?int $id;
    private int $productId;
    private int $userId;
    private int $rating;
    private string $comment;
    private \DateTimeImmutable $createdAt;
    public function __construct(int $productId, int $userId, int $rating, string $comment, ?int $id = null, ?\DateTimeImmutable $createdAt = null) {
        $this->id = $id;
        $this->productId = $productId;
        $this->userId = $userId;
        $this->rating = $rating;
        $this->comment = $comment;
        $this->createdAt = $createdAt ?? new \DateTimeImmutable();
    }
    public function getId(): ?int { return $this->id; }
    public function getProductId(): int { return $this->productId; }
    public function getUserId(): int { return $this->userId; }
    public function getRating(): int { return $this->rating; }
    public function getComment(): string { return $this->comment; }
    public function getCreatedAt(): \DateTimeImmutable { return $this->createdAt; }
}
