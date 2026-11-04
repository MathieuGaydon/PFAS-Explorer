<?php

namespace App\Model;

final class User
{
    public function __construct(
        public readonly int $id,
        public readonly string $email,
        public readonly string $passwordHash
    ) {
    }

    public function verifierMotDePasse(string $motDePasseClair): bool
    {
        return password_verify($motDePasseClair, $this->passwordHash);
    }
}