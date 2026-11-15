<?php

namespace App\Model;

use PDO;

final class UserRepository
{
    public function __construct(private readonly PDO $pdo)
    {
    }

    public function emailExists(string $email): bool
    {
        return $this->findByEmail($email) !== null;
    }

    public function findByEmail(string $email): ?User
    {
        $stmt = $this->pdo->prepare('SELECT id, email, password FROM "Public"."User" WHERE email = :email');
        $stmt->execute(['email' => $email]);
        $utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$utilisateur) {
            return null;
        }

        return $this->hydrater($utilisateur);
    }

    public function hydrater(array $ligne): User
    {
        return new User((int)$ligne['id'], (string)$ligne['email'], (string)$ligne['password']);
    }

    public function create(string $email, string $motDePasseClair): User
    {
        $hash = password_hash($motDePasseClair, PASSWORD_DEFAULT);

        $stmt = $this->pdo->prepare('INSERT INTO "Public"."User" (email, password, id_role) VALUES (:email, :password, :id_role)');
        $stmt->execute(['email' => $email, 'password' => $hash, 'id_role' => 1]);

        $id = (int)$this->pdo->lastInsertId();

        return new User($id, $email, $hash);
    }

    public function updatePassword(int $id, string $motDePasseClair): bool
    {
        $hash = password_hash($motDePasseClair, PASSWORD_DEFAULT);
        $stmt = $this->pdo->prepare('UPDATE "Public"."User" SET password = :password WHERE id = :id');

        return $stmt->execute([
            'password' => $hash,
            'id' => $id
        ]);
    }
}