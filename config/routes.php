<?php

use App\Controller\AuthController;
use App\Controller\HomeController;
use App\Controller\LegalNoticeController;
use App\Controller\SiteMapController;
use App\Controller\ForgotPasswordController;
use App\Controller\ResetPasswordController;
use App\Controller\MapController;

return [
    ['GET', '/', [HomeController::class, 'index']],
    ['GET', '/login', [AuthController::class, 'loginForm']],
    ['POST', '/login', [AuthController::class, 'login']],
    ['GET', '/register', [AuthController::class, 'registerForm']],
    ['POST', '/register', [AuthController::class, 'register']],
    ['POST', '/logout', [AuthController::class, 'logout']],
    ['GET', '/legalnotice', [LegalNoticeController::class, 'index']],
    ['GET', '/sitemap', [SiteMapController::class, 'index']],
    ['GET',  '/forgot-password', [ForgotPasswordController::class, 'form']],
    ['POST', '/forgot-password', [ForgotPasswordController::class, 'send']],
    ['GET', '/reset-password-verify', [ResetPasswordController::class, 'verifyForm']],
    ['POST', '/reset-password-verify', [ResetPasswordController::class, 'verifySend']],
    ['GET', '/reset-password', [ResetPasswordController::class, 'resetForm']],
    ['POST', '/reset-password', [ResetPasswordController::class, 'resetSend']],
    ['GET', '/api/dots', [MapController::class, 'dots']],
];