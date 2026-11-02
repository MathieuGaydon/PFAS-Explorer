<?php
namespace App\Model;

use PDO;

final class UserRepository
{
    public function __construct(private readonly PDO $pdo)
    {
    }

    public function findByEmail(string $email): ?User
    {
        $stmt = $this->pdo->prepare('SELECT id, email, password FROM users WHERE email = :email');
        $stmt->execute(['email' => $email]);
        $utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$utilisateur) {
            return null;
        }

        return $this->hydrater($utilisateur);
    }

    public function emailExists(string $email): bool
    {
        return $this->findByEmail($email) !== null;
    }

    public function create(string $email, string $motDePasseClair): User
    {
        $hash = password_hash($motDePasseClair, PASSWORD_DEFAULT);
        $stmt = $this->pdo->prepare('INSERT INTO users (email, password) VALUES (:email, :password)');
        $stmt->execute([
            'email' => $email,
            'password' => $hash,
        ]);

        $id = $this->pdo->lastInsertId();
        return new User($id, $email, $hash);
    }

    public function hydrater(array $ligne): User
    {
        return new User(
            (int)$ligne['id'],
            (string)$ligne['email'],
            (string)$ligne['password']
        );
    }
}