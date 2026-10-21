<?php
namespace App\Controller;

use App\Model\UserRepository;
use App\Core\Request;
use App\Core\Response;
use App\Core\View;

class AuthController
{
    public function __construct(
        private readonly UserRepository $repository,
        private readonly View $view
    ) {}

    public function loginForm(Request $request): Response
    {
        if ($request->session('utilisateur') !== null) {
            return Response::redirect('/');
        }

        $titre = 'Connexion';
        $erreur = null;
        $email = '';

        return $this->view->render('login', [
            'titre1' => $titre,
            'titre2' => $titre,
            'erreur' => $erreur,
            'email' => $email,
        ]);
    }

    public function login(Request $request): Response
    {
        if ($request->session('utilisateur') !== null) {
            return Response::redirect('/');
        }

        $email = trim((string) $request->post('email', ''));
        $password = (string) $request->post('password', '');

        $utilisateur = $this->repository->findByEmail($email);

        if ($utilisateur !== null && $utilisateur->verifierMotDePasse($password)) {
            $request->setSession('utilisateur', [
                'id' => $utilisateur->id,
                'email' => $utilisateur->email
            ]);
            return Response::redirect('/');
        }

        $titre = 'Connexion';
        $erreur = 'Email ou mot de passe incorrect.';

        return $this->view->render('login', [
            'titre1' => $titre,
            'titre2' => $titre,
            'erreur' => $erreur,
            'email' => $email,
        ]);
    }

    public function registerForm(Request $request): Response
    {
        $titre = 'Inscription';
        $erreurs = [];
        $succes = false;
        $email = '';

        return $this->view->render('register', [
            'titre1' => $titre,
            'titre2' => $titre,
            'erreurs' => $erreurs,
            'succes' => $succes,
            'email' => $email,
        ]);
    }

    public function register(Request $request): Response
    {
        $titre = 'Inscription';
        $erreurs = [];
        $succes = false;

        $email = trim((string) $request->post('email', ''));
        $password = (string) $request->post('password', '');
        $confirmation = (string) $request->post('confirmation', '');

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $erreurs[] = 'L\'adresse email est invalide.';
        }
        if (strlen($password) < 8) {
            $erreurs[] = 'Le mot de passe doit contenir au moins 8 caractères.';
        }
        if ($password !== $confirmation) {
            $erreurs[] = 'Les deux mots de passe ne correspondent pas.';
        }

        if (empty($erreurs)) {
            if ($this->repository->findByEmail($email)) {
                $erreurs[] = 'Un compte existe déjà avec cet email.';
            }
        }

        if (empty($erreurs)) {
            $this->repository->create($email, $password);
            $succes = true;
        }

        return $this->view->render('register', [
            'titre1' => $titre,
            'titre2' => $titre,
            'erreurs' => $erreurs,
            'succes' => $succes,
            'email' => $email,
        ]);
    }

    public function logout(Request $request): Response
    {
        $request->detruireSession();
        return Response::redirect('/');
    }
}