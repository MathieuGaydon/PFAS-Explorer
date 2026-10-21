<?php
namespace App\Core;

final class Request {
    public function __construct(
        public readonly string $methode,
        public readonly string $chemin,
        private array $parametresGet = [],
        private array $parametresPost = [],
        private array $donneesSession = []
    ) {}

    public static function fromGlobals(): self {
        $methode = $_SERVER['REQUEST_METHOD'];
        $chemin = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?: '/';
        $chemin = rtrim($chemin, '/') ?: '/';

        return new self($methode, $chemin, $_GET, $_POST, $_SESSION ?? []);
    }

    public function get(string $cle, mixed $defaut = null): mixed {
        return $this->parametresGet[$cle] ?? $defaut;
    }

    public function post(string $cle, mixed $defaut = null): mixed {
        return $this->parametresPost[$cle] ?? $defaut;
    }

    public function session(string $cle, mixed $defaut = null): mixed {
        return $_SESSION[$cle] ?? $this->donneesSession[$cle] ?? $defaut;
    }

    public function setSession(string $cle, mixed $valeur): void {
        $_SESSION[$cle] = $valeur;
        $this->donneesSession[$cle] = $valeur;
    }

    public function detruireSession(): void {
        $_SESSION = [];
        $this->donneesSession = [];
        if (session_status() === PHP_SESSION_ACTIVE) {
            session_destroy();
        };
    }


}