<?php
namespace App\View;

final class Layout extends Component {
    public function __construct(
        private readonly string $titre1, $titre2,
        private readonly ?array $utilisateurs,
        private readonly array $enfants,
    ) {}

    public function render(): string {
        $titre1 = $this->e($this->titre1);
        $titre2 = $this->e($this->titre2);

        $nav = $this->renderAll($this->utilisateurs === null
            ? [new Link('/', 'Accueil'), ' | ', new Link('/login', 'Connexion'), ' | ', new Link('/register', 'Inscription')]
            : [new Link('/', 'Accueil'), ' | ', new Link('/logout', 'Déconnexion')]
        );

        $contenu = $this->renderAll($this->enfants);

        return <<<HTML
        <!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <title>{$titre1}</title>
        </head>
        <body>
        <nav>
            {$nav}
        </nav>
        <h1>{$titre2}</h1>
        
        {$contenu}
        
        </body>
        </html>
        HTML;
    }
}