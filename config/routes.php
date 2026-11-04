<?php

use App\Controller\AuthController;
use App\Controller\HomeController;
use App\Controller\LegalNoticeController;
use App\Controller\SiteMapController;

return [
    ['GET', '/', [HomeController::class, 'index']],
    ['GET', '/login', [AuthController::class, 'loginForm']],
    ['POST', '/login', [AuthController::class, 'login']],
    ['GET', '/register', [AuthController::class, 'registerForm']],
    ['POST', '/register', [AuthController::class, 'register']],
    ['POST', '/logout', [AuthController::class, 'logout']],
    ['GET', '/legalnotice', [LegalNoticeController::class, 'index']],
    ['GET', '/sitemap', [SiteMapController::class, 'index']],
];