<?php
use App\View\Layout;
use App\View\Paragraph;
use App\View\Link;
use App\View\Strong;

$enfants = [];
if ($utilisateurConnecte !== null) {
    $enfants[] = new Paragraph([
            'Bonjour ',
            new Strong($utilisateurConnecte['email']),
            ', vous êtes connecté.'
            ]);
} else {
    $enfants[] = new Paragraph([
            'Vous n\'êtes pas connecté. ',
            new Link('/login', 'Connectez-vous'),
            ' ou ',
            new Link('/register', 'créez un compte'),
            '.'
            ]);
}

echo new Layout(
        'Accueil',
        'Bienvenue',
        $utilisateurConnecte,
        $enfants
);

