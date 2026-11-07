<?php

namespace App\Core;

use PDO;
use RuntimeException;
use PDOException;

final class Database
{
    public static function connexion(string $racine): PDO
    {
        $dsn = Env::get('DB_DSN') ?? throw new RuntimeException('DB_DSN non défini');

        if (str_starts_with($dsn, 'sqlite:') && !str_starts_with(substr($dsn, 7), '/')) {
            $dsn = 'sqlite:' . $racine . '/' . substr($dsn, 7);
        }

        try {
            $pdo = new PDO($dsn, Env::get('DB_USER') ?: null, Env::get('DB_PASSWORD') ?: null);
        } catch (PDOException $e) {
            error_log('Erreur de connexion à la base de données : ' . $e->getMessage());
            throw new \RuntimeException('Impossible de se connecter à la base de données');
        }

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->exec('CREATE TABLE IF NOT EXISTS "Users"."User" (
            id SERIAL PRIMARY KEY,
            email TEXT NOT NULL UNIQUE,
            password TEXT NOT NULL
            )');

        return $pdo;
    }
}