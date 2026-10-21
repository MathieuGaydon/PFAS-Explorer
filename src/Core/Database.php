<?php
namespace App\Core;

use PDO;

final class Database {
    public static function connexion(string $racine): PDO {
        Env::charger($racine . '/.env');

        $dsn = Env::get('DB_DSN') ?? throw new \RuntimeException('DB_DSN non défini');

        if (str_starts_with($dsn, 'sqlite:') && !str_starts_with(substr($dsn, 7), '/')) {
            $dsn = 'sqlite:' . $racine . '/' . substr($dsn, 7);
        }

        $pdo = new PDO($dsn, Env::get('DB_USER') ?: null, Env::get('DB_PASSWORD') ?: null);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->exec('CREATE TABLE IF NOT EXISTS users (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            email TEXT NOT NULL UNIQUE,
            password TEXT NOT NULL
            )');

        return $pdo;
    }
}