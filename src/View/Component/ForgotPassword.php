<?php

namespace App\View\Component;

final class ForgotPassword extends Component
{
    public function __construct(
        private readonly array $erreurs,
        private readonly string $email
    ) {
    }

    public function render(): string
    {
        return $this->renderAll([
            new Alert($this->erreurs),
            new Paragraph([
                implode(' ', [
                    'Saisissez l’adresse email de votre compte.',
                    'Si un compte existe avec cette adresse,',
                    'un code de vérification vous sera envoyé.'
                ])
            ]),
            new Form('/forgot-password', [
                new Input('email', 'Adresse email', 'email', $this->email),
                new Button('Envoyer le code'),
            ]),
            new Paragraph([
                'Vous vous souvenez de votre mot de passe ? ',
                new Link('/login', 'Retour à la connexion'),
                '.'
            ]),
        ]);
    }
}