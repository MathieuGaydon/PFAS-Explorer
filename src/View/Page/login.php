<?php

use App\View\Component\Alert;
use App\View\Component\Button;
use App\View\Component\Form;
use App\View\Component\Input;
use App\View\Component\Layout;
use App\View\Component\Link;
use App\View\Component\Paragraph;

$messageSucces = $_SESSION['message_succes'] ?? null;
unset($_SESSION['message_succes']);

$enfants = [];

if ($messageSucces !== null) {
    $enfants[] = new Paragraph([$messageSucces]);
}
$enfants[] = new Alert($erreur === null ? [] : [$erreur]);

$enfants[] = new Form('/login', [
    new Input('email', 'Email', 'email', $email ?? ''),
    new Input('password', 'Mot de passe', 'password'),
    new Button('Se connecter'),
    new Paragraph([
        new Link('/forgot-password', 'Mot de passe oublié ?')
    ]),
]);

$enfants[] = new Paragraph([
    'Pas encore de compte ? ',
    new Link('/register', 'Inscrivez-vous'),
    '.'
]);

echo new Layout(
    title: 'PFAS-Explorer - Connexion',
    description: 'Connectez-vous à votre PFAS-Explorer.',
    enfants: $enfants,
    utilisateurs: $utilisateurs ?? null,
    smTitle: 'PFAS-Explorer - Connexion',
    smDescription: 'Connectez-vous à votre PFAS-Explorer.',
    smImage: 'http://localhost:8000/_assets/images/Logo_PFAS.webp',
    smUrl: 'http://localhost:8000/login'
);