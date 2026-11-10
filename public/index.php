<?php
$racine = dirname(__DIR__);                    // on est dans public/, le projet est un cran au-dessus

require $racine . '/autoload.php';
session_start();                               // une seule fois, pour tout le site

use App\Controller\AuthController;
use App\Controller\HomeController;
use App\Controller\LegalNoticeController;
use App\Controller\SiteMapController;
use App\Controller\ForgotPasswordController;
use App\Controller\ResetPasswordController;
use App\Controller\MapController;
use App\Core\Database;
use App\Core\Env;
use App\Core\Request;
use App\Core\Router;
use App\Core\View;
use App\Model\UserRepository;

Env::charger($racine . '/.env');

$pdo = Database::connexion($racine);

$repository = new UserRepository($pdo);

$view = new View($racine . '/src/View/Page', ['utilisateurs' => $_SESSION['utilisateur'] ?? null]);

$fabriques = [
    HomeController::class => fn() => new HomeController($view),
    AuthController::class => fn() => new AuthController($repository, $view),
    LegalNoticeController::class => fn() => new LegalNoticeController($view),
    SiteMapController::class => fn() => new SiteMapController($view),
    ForgotPasswordController::class => fn() => new ForgotPasswordController(
        $repository,
        $pdo,
        $view
    ),
    ResetPasswordController::class => fn() => new ResetPasswordController(
        $repository,
        $pdo,
        $view
    ),
];

$request = Request::fromGlobals();

$routes = require $racine . '/config/routes.php';

$router = new Router($routes, $fabriques, $view);
$router->dispatch($request)->send();