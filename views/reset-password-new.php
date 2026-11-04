<?php

use App\View\Alert;
use App\View\Button;
use App\View\Form;
use App\View\Input;
use App\View\Layout;
use App\View\Paragraph;

$enfants = [
    new Alert($erreurs ?? []),
    new Paragraph([
        'Choisissez un nouveau mot de passe pour votre compte.'
    ]),
    new Form('/reset-password', [
        new Input('password', 'Nouveau mot de passe', 'password'),
        new Input('confirmation', 'Confirmation du mot de passe', 'password'),
        new Button('Modifier mon mot de passe'),
    ]),
];

echo new Layout(
    title: 'PFAS-Explorer - Nouveau mot de passe',
    description: 'Choisissez un nouveau mot de passe pour votre compte PFAS-Explorer.',
    enfants: $enfants,
    utilisateurs: $utilisateurs ?? null,
    smTitle: 'PFAS-Explorer - Nouveau mot de passe',
    smDescription: 'Choisissez un nouveau mot de passe pour votre compte PFAS-Explorer.',
    smImage: 'http://localhost:8000/_assets/images/Logo_PFAS.webp',
    smUrl: 'http://localhost:8000/reset-password'
);
