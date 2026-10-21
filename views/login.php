<?php
use App\View\Alert;
use App\View\Button;
use App\View\Form;
use App\View\Input;
use App\View\Layout;
use App\View\Link;
use App\View\Paragraph;

echo new Layout(
        'Connexion',
        'Connexion',
        $utilisateurConnecte ?? null,
        [
            new Alert($erreur === null ? [] : [$erreur]),
            new Form('/login', [
                new Input('email', 'Email', 'email', $email ?? ''),
                new Input('password', 'Mot de passe', 'password'),
                new Button('Se connecter'),
        ]),
        new Paragraph(['Pas encore de compte ? ', new Link('/register', 'Inscrivez-vous'), '.'
        ])
]);

