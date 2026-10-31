<?php
use App\View\Layout;
use App\View\Paragraph;
use App\View\Link;
use App\View\Strong;

$enfants = [];
if ($utilisateurs !== null) {
    $enfants[] = new Paragraph([
        'Bonjour ',
        new Strong($utilisateurs['email']),
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
    title: 'Accueil - PFAS-EXPLORER',
    description: 'PFAS-Explorer est une application web cartographique permettant d\'explorer les contaminations aux PFAS et de gérer des espaces de travail et des données environnementales.',
    smTitle: 'PFAS-Explorer - Accueil',
    smDescription: 'PFAS-Explorer est une application web cartographique permettant d\'explorer les contaminations aux PFAS et de gérer des espaces de travail et des données environnementales.',
    smImage: 'http://localhost:8000/_assets/images/Logo_PFAS.webp',
    smUrl: 'http://localhost:8000/',
    utilisateurs: $utilisateurs,
    enfants: $enfants
);

