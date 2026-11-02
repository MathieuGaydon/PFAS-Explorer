<?php
namespace App\Core;

final class View {

    public function __construct(
         private readonly string $dossier,
        private readonly array $partage = []
    ) {}

    public function render(string $vue, array $donnees = [], int $statut = 200): Response
    {
        return new Response($statut, $this->capturer($vue . '.php', $donnees + $this->partage));
    }

    private function capturer(string $fichier, array $donnees): string
    {
        extract($donnees, EXTR_SKIP);
        ob_start();
        require $this->dossier . '/' . $fichier;

        return ob_get_clean();
    }
}