<?php
namespace App\Controller;

use App\Core\Request;
use App\Core\Response;
use App\Core\View;

final class LegalNoticeController {
    public function __construct(private readonly View $view) {}

    public function index(Request $request): Response {

        return $this->view->render('legalnotice', [
            'utilisateurs' => $request->session('utilisateur'),
        ]);
    }
}