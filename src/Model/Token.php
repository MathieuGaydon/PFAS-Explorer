<?php

namespace App\Model;

use PDO;

final class Token
{
    public function __construct(private readonly PDO $pdo)
    {
        $this->initTable();
    }

    private function initTable(): void
    {
        $this->pdo->exec('CREATE TABLE IF NOT EXISTS "Token" (
            id INTEGER GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
            user_id INTEGER NOT NULL,
            token TEXT NOT NULL,
            expires_at TIMESTAMPTZ NOT NULL,
            FOREIGN KEY (user_id) REFERENCES "User"(id) ON DELETE CASCADE
        )');
    }

    public static function generate(): string
    {
        return strtoupper(bin2hex(random_bytes(4)));
    }

    private static function hash(string $token): string
    {
        $normalized = strtoupper(preg_replace('/\s+/', '', $token));

        return hash('sha256', $normalized);
    }

    public function createForUser(int $userId, string $token, int $minutes = 15): bool
    {
        $this->deleteExpired();
        $this->deleteForUser($userId);

        $stmt = $this->pdo->prepare(
            "INSERT INTO \"Token\" (
                user_id,
                token,
                expires_at
            ) VALUES (
                :user_id,
                :token,
                NOW() + (:minutes * INTERVAL '1 minute')
            )"
        );

        return $stmt->execute([
            'user_id' => $userId,
            'token' => self::hash($token),
            'minutes' => $minutes
        ]);
    }

    public function isValid(int $userId, string $token): bool
    {
        $stmt = $this->pdo->prepare(
            'SELECT 1 FROM "Token" WHERE user_id = :user_id AND token = :token AND expires_at > CURRENT_TIMESTAMP'
        );
        $stmt->execute([
            'user_id' => $userId,
            'token' => self::hash($token)
        ]);

        return (bool) $stmt->fetchColumn();
    }

    public function deleteForUser(int $userId): bool
    {
        $stmt = $this->pdo->prepare('DELETE FROM "Token" WHERE user_id = :user_id');

        return $stmt->execute(['user_id' => $userId]);
    }

    public function deleteExpired(): int
    {
        $stmt = $this->pdo->prepare('DELETE FROM "Token" WHERE expires_at <= CURRENT_TIMESTAMP');
        $stmt->execute();

        return $stmt->rowCount();
    }
}