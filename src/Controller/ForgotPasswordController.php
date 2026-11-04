<?php

namespace App\Controller;

use App\Core\Request;
use App\Core\Response;
use App\Core\View;
use App\Model\UserRepository;
use App\Model\Token;
use PDO;

final class ForgotPasswordController
{
    private const TOKEN_LIFETIME_MINUTES = 15;

    public function __construct(
        private readonly UserRepository $repository,
        private readonly PDO $pdo,
        private readonly View $view
    ) {
    }

    public function form(Request $request): Response
    {
        if ($request->session('utilisateur') !== null) {
            return Response::redirect('/');
        }

        return $this->view->render('forgot-password', [
            'erreurs' => [],
            'email' => '',
            'utilisateurs' => $request->session('utilisateur'),
        ]);
    }

    public function send(Request $request): Response
    {
        if ($request->session('utilisateur') !== null) {
            return Response::redirect('/');
        }

        $erreurs = [];
        $email = trim((string)$request->post('email', ''));

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $erreurs[] = 'L\'adresse email n\'est pas valide.';
        } else {
            $utilisateur = $this->repository->findByEmail($email);

            if ($utilisateur !== null) {
                $tokenModel = new Token($this->pdo);
                $code = Token::generate();
                $tokenModel->createForUser($utilisateur->id, $code, self::TOKEN_LIFETIME_MINUTES);

                if ($this->sendResetMail($utilisateur->email, $code)) {
                    $request->setSession('reset_user_id', $utilisateur->id);
                } else {
                    $tokenModel->deleteForUser($utilisateur->id);
                    $erreurs[] = 'Impossible d\'envoyer l\'email pour le moment, veuillez réessayer.';
                }
            }

            if (empty($erreurs)) {
                return Response::redirect('/reset-password-verify');
            }
        }

        return $this->view->render('forgot-password', [
            'erreurs' => $erreurs,
            'email' => $email,
            'utilisateurs' => $request->session('utilisateur'),
        ]);
    }

    private function sendResetMail(string $email, string $code): bool
    {
        $to = $email;
        $subject = 'Réinitialisation de votre mot de passe - PFAS-Explorer';
        $headers = "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=UTF-8\r\n";
        $headers .= "From: PFAS-Explorer <no-reply@pfas-explorer.alwaysdata.net>\r\n";

        $message = '
        <!DOCTYPE html>
        <html lang="fr">
        <head><meta charset="UTF-8"><title>Réinitialisation</title></head>
        <body>
            <h2>Réinitialisation de mot de passe</h2>
            <p>Voici votre code de vérification :</p>
            <p style="font-size: 24px; font-weight: bold; letter-spacing: 4px;">' . htmlspecialchars($code) . '</p>
            <p>Ce code est valide pendant ' . self::TOKEN_LIFETIME_MINUTES . ' minutes.</p>
        </body>
        </html>
        ';

        return mail($to, $subject, $message, $headers);
    }
}