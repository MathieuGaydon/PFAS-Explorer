<?php

namespace App\Core;

final class Response
{
    public function __construct(public int $statut = 200, public string $corps = '', public array $entetes = [])
    {
    }

    public static function redirect(string $url): self
    {
        return new self(302, '', ['Location' => $url]);
    }

    public static function json(mixed $donnees, int $statut = 200): self
    {
        return new self(
            $statut,
            json_encode($donnees, JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR),
            ['Content-Type' => 'application/json; charset=utf-8']
        );
    }

    public function send(): void
    {
        http_response_code($this->statut);

        foreach ($this->entetes as $nom => $valeur) {
            header("$nom: $valeur");
        }

        echo $this->corps;
    }
}