<?php

namespace App\Controller;

use App\Core\Request;
use App\Core\Response;
use App\Core\View;
use App\Model\UserRepository;
use App\Model\Token;
use PDO;

final class ResetPasswordController
{
    public function __construct(
        private readonly UserRepository $repository,
        private readonly PDO $pdo,
        private readonly View $view
    ) {
    }

    /**
     * Étape 2A : Formulaire de saisie du code de vérification
     */
    public function verifyForm(Request $request): Response
    {
        if ($request->session('utilisateur') !== null) {
            return Response::redirect('/');
        }

        $userId = $request->session('reset_user_id');
        if ($userId === null) {
            return Response::redirect('/forgot-password');
        }

        return $this->view->render('reset-password-verify', [
            'erreurs' => [],
            'utilisateurs' => $request->session('utilisateur'),
        ]);
    }

    /**
     * Étape 2B : Traitement de la vérification du code
     */
    public function verifySend(Request $request): Response
    {
        if ($request->session('utilisateur') !== null) {
            return Response::redirect('/');
        }

        $userId = (int) $request->session('reset_user_id');
        $code = trim((string) $request->post('code', ''));
        $erreurs = [];

        if ($userId === 0) {
            return Response::redirect('/forgot-password');
        }

        $tokenModel = new Token($this->pdo);

        if (!$tokenModel->isValid($userId, $code)) {
            $erreurs[] = 'Le code saisi est invalide ou expiré.';
        } else {
            // Le code est bon, on autorise l'étape finale pendant 15 minutes
            $request->setSession('reset_verified_user', $userId);
            $request->setSession('reset_verified_until', time() + 900);

            return Response::redirect('/reset-password');
        }

        return $this->view->render('reset-password-verify', [
            'erreurs' => $erreurs,
            'utilisateurs' => $request->session('utilisateur'),
        ]);
    }

    /**
     * Étape 3A : Formulaire de saisie du nouveau mot de passe
     */
    public function resetForm(Request $request): Response
    {
        if ($request->session('utilisateur') !== null) {
            return Response::redirect('/');
        }

        $userId = $request->session('reset_verified_user');
        $until = (int) $request->session('reset_verified_until', 0);

        if ($userId === null || time() > $until) {
            return Response::redirect('/forgot-password');
        }

        return $this->view->render('reset-password-new', [
            'erreurs' => [],
            'utilisateurs' => $request->session('utilisateur'),
        ]);
    }

    /**
     * Étape 3B : Mise à jour finale du mot de passe
     */
    public function resetSend(Request $request): Response
    {
        if ($request->session('utilisateur') !== null) {
            return Response::redirect('/');
        }

        $userId = (int) $request->session('reset_verified_user');
        $until = (int) $request->session('reset_verified_until', 0);

        if ($userId === 0 || time() > $until) {
            return Response::redirect('/forgot-password');
        }

        $password = (string) $request->post('password', '');
        $confirmation = (string) $request->post('confirmation', '');
        $erreurs = [];

        if (strlen($password) < 8) {
            $erreurs[] = 'Le mot de passe doit contenir au moins 8 caractères.';
        }

        if ($password !== $confirmation) {
            $erreurs[] = 'Les mots de passe ne correspondent pas.';
        }

        if (empty($erreurs)) {
            // Mise à jour du mot de passe
            if ($this->repository->updatePassword($userId, $password)) {
                // Nettoyage des tokens en BDD
                (new Token($this->pdo))->deleteForUser($userId);

                // Nettoyage des données temporaires de session
                unset(
                    $_SESSION['reset_user_id'],
                    $_SESSION['reset_verified_user'],
                    $_SESSION['reset_verified_until']
                );

                $_SESSION['message_succes'] = 'Votre mot de passe a bien été modifié. Vous pouvez maintenant vous connecter.';

                return Response::redirect('/login');
            }

            $erreurs[] = 'Une erreur est survenue lors de la mise à jour.';
        }

        return $this->view->render('reset-password-new', [
            'erreurs' => $erreurs,
            'utilisateurs' => $request->session('utilisateur'),
        ]);
    }
}