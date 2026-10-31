<?php
use App\View\Alert;
use App\View\Button;
use App\View\Form;
use App\View\Input;
use App\View\Layout;
use App\View\Link;
use App\View\Paragraph;

$enfants = [
    new Alert($erreur === null ? [] : [$erreur]),
    new Form('/login', [
        new Input('email', 'Email', 'email', $email ?? ''),
        new Input('password', 'Mot de passe', 'password'),
        new Button('Se connecter'),
    ]),
    new Paragraph(['Pas encore de compte ? ', new Link('/register', 'Inscrivez-vous'), '.'
    ])
];

echo new Layout(
        title: 'PFAS-Explorer - Connexion',
        description: 'Connectez-vous à votre PFAS-Explorer.',
        smTitle: 'PFAS-Explorer - Connexion',
        smDescription: 'Connectez-vous à votre PFAS-Explorer.',
        smImage: 'http://localhost:8000/_assets/images/Logo_PFAS.webp',
        smUrl: 'http://localhost:8000/login',
        utilisateurs: $utilisateurs ?? null,
        enfants: $enfants
);

