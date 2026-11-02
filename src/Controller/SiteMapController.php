<?php
namespace App\Controller;

use App\Core\Request;
use App\Core\Response;
use App\Core\View;

final class SiteMapController {
    public function __construct(private readonly View $view) {}

    public function index(Request $request): Response {

        return $this->view->render('sitemap', [
            'utilisateurs' => $request->session('utilisateur'),
        ]);
    }
}