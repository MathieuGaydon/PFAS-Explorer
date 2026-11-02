<?php
namespace App\Core;

final class Router {
    public function __construct(
        private readonly array $routes,
        private readonly array $fabriques,
        private readonly View $view
    ) {}

    public function dispatch(Request $request): Response
    {
        foreach ($this->routes as [$methode, $chemin, [$classe, $action]]) {
            if ($methode === $request->methode && $chemin === $request->chemin) {
                $controleur = ($this->fabriques[$classe])();
                return $controleur->$action($request);
            }
        }
        return $this->view->render('404', ['chemin' => $request->chemin], 404);
    }
}
