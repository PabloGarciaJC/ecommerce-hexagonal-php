<?php
namespace Infrastructure\Persistence;

use Domain\Repository\UserRepositoryInterface;
use Domain\Entity\User;
use PDO;

class MySQLUserRepository implements UserRepositoryInterface
{
    private PDO $connection;

    public function __construct(PDO $connection)
    {
        // ← Aquí se inyecta la conexión concreta a la base de datos
        $this->connection = $connection;
    }

    public function save(User $user): void
    {
        $stmt = $this->connection->prepare(
            'INSERT INTO users (name, email, password, created_at) VALUES (:name, :email, :password, :created_at)'
        );
        $stmt->execute([
            ':name' => $user->getName(),
            ':email' => $user->getEmail(),
            ':password' => $user->getPasswordHash(),
            ':created_at' => $user->getCreatedAt()->format('Y-m-d H:i:s')
        ]);

        // Actualizar id en la entidad
        $id = (int)$this->connection->lastInsertId();
        if ($id > 0) {
            $user->setId($id);
        }
    }

    public function findAll(): array
    {
        $stmt = $this->connection->query('SELECT id, name, email, password, created_at FROM users ORDER BY id DESC');
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $users = [];
        foreach ($rows as $r) {
            $users[] = new User($r['name'], $r['email'], (int)$r['id'], new \DateTimeImmutable($r['created_at']), $r['password'] ?? null);
        }
        return $users;
    }

    public function findById(int $id): ?User
    {
        $stmt = $this->connection->prepare('SELECT id, name, email, password, created_at FROM users WHERE id = :id');
        $stmt->execute([':id' => $id]);
        $r = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$r) return null;
        return new User($r['name'], $r['email'], (int)$r['id'], new \DateTimeImmutable($r['created_at']), $r['password'] ?? null);
    }

    public function findByEmail(string $email): ?User
    {
        $stmt = $this->connection->prepare('SELECT id, name, email, password, created_at FROM users WHERE email = :email');
        $stmt->execute([':email' => $email]);
        $r = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$r) return null;
        return new User($r['name'], $r['email'], (int)$r['id'], new \DateTimeImmutable($r['created_at']), $r['password'] ?? null);
    }

    public function update(User $user): void
    {
        $stmt = $this->connection->prepare(
            'UPDATE users SET name = :name, email = :email, password = :password WHERE id = :id'
        );
        $stmt->execute([
            ':name' => $user->getName(),
            ':email' => $user->getEmail(),
            ':password' => $user->getPasswordHash(),
            ':id' => $user->getId(),
        ]);
    }

    public function deleteById(int $id): void
    {
        $stmt = $this->connection->prepare('DELETE FROM users WHERE id = :id');
        $stmt->execute([':id' => $id]);
    }
}
