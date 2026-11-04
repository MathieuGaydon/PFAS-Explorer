<?php
use App\View\Layout;
use App\View\ForgotPassword;

echo new Layout(
    title: 'PFAS-Explorer - Mot de passe oublié',
    description: 'Réinitialisez votre mot de passe de votre compte PFAS-Explorer.',
    smTitle: 'PFAS-Explorer - Mot de passe oublié',
    smDescription: 'Réinitialisez votre mot de passe de votre compte PFAS-Explorer.',
    smImage: 'https://pfas-explorer.alwaysdata.net/_assets/images/Logo_PFAS.webp',
    smUrl: 'https://pfas-explorer.alwaysdata.net/forgot-password',
    utilisateurs: $utilisateurs ?? null,
    enfants: [
        new ForgotPassword($erreurs ?? [], $email ?? '')
    ]
);