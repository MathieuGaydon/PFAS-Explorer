<?php
use App\View\Layout;
use App\View\Paragraph;
use App\View\Link;

$enfants = [
        new Paragraph(['La page demandée (', $chemin ?? '', '] n\'existe pas.']),
        new Paragraph([new Link('/', 'Retourner à l\'accueil')])
];

echo new Layout(
        'Erreur 404',
        'Page non trouvée',
        $utilisateurConnecte ?? null,
        $enfants
);