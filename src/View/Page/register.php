<?php

use App\View\Component\Alert;
use App\View\Component\Button;
use App\View\Component\Form;
use App\View\Component\Input;
use App\View\Component\Layout;
use App\View\Component\Link;
use App\View\Component\Paragraph;

if ($succes ?? false) {
    $enfants = [
        new Paragraph([
            'Votre compte a été créé. ',
            new Link('/login', 'Connectez-vous'),
            '.'
        ])
    ];
} else {
    $enfants = [
        new Alert($erreurs ?? []),
        new Form('/register', [
            new Input('email', 'Email', 'email', $email ?? ''),
            new Input('password', 'Mot de passe', 'password', $password ?? ''),
            new Input('confirmation', 'Confirmation mot de passe', 'password'),
            new Button('S\'inscrire')
        ])
    ];
}

echo new Layout(
    title: 'PFAS-Explorer - Inscription',
    description: 'Inscrivez-vous dès maintenant sur le site PFAS-Explorer.',
    enfants: $enfants,
    utilisateurs: $utilisateurs ?? null,
    smTitle: 'PFAS-Explorer - Inscription',
    smDescription: 'Inscrivez-vous dès maintenant sur le site PFAS-Explorer.',
    smImage: 'http://localhost:8000/_assets/images/Logo_PFAS.webp',
    smUrl: 'http://localhost:8000/register'
);
