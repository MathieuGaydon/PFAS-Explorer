<?php
$racine = dirname(__DIR__);                    // on est dans public/, le projet est un cran au-dessus

require $racine . '/autoload.php';
session_start();                               // une seule fois, pour tout le site

use App\Core\Env;
use App\Core\Database;
use App\Core\View;
use App\Core\Router;
use App\Core\Request;
use App\Model\UserRepository;
use App\Controller\HomeController;
use App\Controller\AuthController;

Env::charger($racine . '/.env');
$pdo = Database::connexion($racine);
$repository = new UserRepository($pdo);

$view = new View($racine . '/views', ['utilisateurConnecte' => $_SESSION['utilisateur'] ?? null]);

$fabriques = [
    HomeController::class => fn() => new HomeController($view),
    AuthController::class => fn() => new AuthController($repository, $view),
];

$request = Request::fromGlobals();
$response = null;

$routes = require $racine . '/config/routes.php';
$router = new Router($routes, $fabriques, $view);

$router->dispatch(Request::fromGlobals())->send();