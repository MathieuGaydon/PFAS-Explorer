<?php

use App\View\Component\Layout;
use App\View\Component\Link;
use App\View\Component\MapView;
use App\View\Component\Paragraph;
use App\View\Component\Strong;

$enfants = [];

if ($utilisateurs === null) {
    $enfants[] = new Paragraph([
        'Bienvenue sur ',
        new Strong('PFAS-Explorer'),
        ', votre plateforme de cartographie et d’analyse des contaminations aux PFAS.'
    ]);

    $enfants[] = new Paragraph([
        'Vous n\'êtes pas connecté. ',
        new Link('/login', 'Connectez-vous'),
        ' ou ',
        new Link('/register', 'créez un compte'),
        '.'
    ]);
} else {
    $enfants[] = new Paragraph([
        'Bonjour ',
        new Strong($utilisateurs['email'] ?? ''),
        ', vous êtes connecté.'
    ]);
}

$enfants[] = new MapView();

echo new Layout(
    title: 'Accueil - PFAS-EXPLORER',
    description: 'PFAS-Explorer est une application web cartographique permettant d\'explorer les contaminations aux PFAS et de gérer des espaces de travail et des données environnementales.',
    enfants: $enfants,
    utilisateurs: $utilisateurs,
    smTitle: 'PFAS-Explorer - Accueil',
    smDescription: 'PFAS-Explorer est une application web cartographique permettant d\'explorer les contaminations aux PFAS et de gérer des espaces de travail et des données environnementales.',
    smImage: 'http://localhost:8000/_assets/images/Logo_PFAS.webp',
    smUrl: 'http://localhost:8000/'
);
