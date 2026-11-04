<?php

use App\View\Component\Layout;
use App\View\Component\Link;
use App\View\Component\Paragraph;

$enfants = [
    new Paragraph([
        'La page demandée (',
        $chemin ?? '',
        ') n\'existe pas.'
    ]),
    new Paragraph([
        new Link('/', 'Retourner à l\'accueil')
    ])
];

echo new Layout(
    title: 'Erreur 404 - PFAS-Explorer',
    description: 'La page demandée n\'existe pas sur PFAS-Explorer.',
    enfants: $enfants,
    utilisateurs: $utilisateurs ?? null,
    smTitle: 'Erreur 404 - Page non trouvée',
    smDescription: 'La page demandée n\'existe pas sur PFAS-Explorer.',
    smImage: 'http://localhost:8000/_assets/images/Logo_PFAS.webp',
    smUrl: 'http://localhost:8000/'
);