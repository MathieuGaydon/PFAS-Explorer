<?php

use App\View\Component\Alert;
use App\View\Component\Button;
use App\View\Component\Form;
use App\View\Component\Input;
use App\View\Component\Layout;
use App\View\Component\Paragraph;
use App\View\Component\Link;

$enfants = [
    new Alert($erreurs ?? []),
    new Paragraph([
        'Un code de vérification vous a été envoyé par email. Saisissez-le ci-dessous.'
    ]),
    new Form('/reset-password-verify', [
        new Input('code', 'Code de vérification', 'text'),
        new Button('Vérifier le code'),
    ]),
    new Paragraph([
        new Link('/forgot-password', 'Renvoyer un code')
    ])
];

echo new Layout(
    title: 'PFAS-Explorer - Vérification du code',
    description: 'Saisissez le code de vérification reçu par email.',
    enfants: $enfants,
    utilisateurs: $utilisateurs ?? null,
    smTitle: 'PFAS-Explorer - Vérification du code',
    smDescription: 'Saisissez le code de vérification reçu par email.',
    smImage: 'http://localhost:8000/_assets/images/Logo_PFAS.webp',
    smUrl: 'http://localhost:8000/reset-password-verify'
);
