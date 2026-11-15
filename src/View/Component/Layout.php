<?php

namespace App\View\Component;

final class Layout extends Component
{
    public function __construct(
        private readonly string $title,
        private readonly string $description,
        private readonly array $enfants,
        private readonly ?array $utilisateurs,
        private readonly ?string $smTitle = null,
        private readonly ?string $smDescription = null,
        private readonly ?string $smImage = null,
        private readonly ?string $smUrl = null
    ) {
    }

    public function render(): string
    {
        $title = $this->e($this->title);
        $description = $this->e($this->description);
        $smTitle = $this->e($this->smTitle ?? '');
        $smDescription = $this->e($this->smDescription ?? '');
        $smImage = $this->e($this->smImage ?? '');
        $smUrl = $this->e($this->smUrl ?? '');

        $nav = $this->renderAll(
            $this->utilisateurs === null
                ? [
                    new Link('/', 'Accueil', 'inside'),
                    new Link('/login', 'Connexion', 'inside'),
                    new Link('/register', 'Inscription', 'inside'),
                ]
                : [
                    new Link('/', 'Accueil', 'inside'),
                    new LogoutForm(),
                ]
        );
        $contenu = $this->renderAll($this->enfants);

        return <<<HTML
        <!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta name="description" content="{$description}">
            <title>{$title}</title>
            <link rel="stylesheet" href="/_assets/styles/style.css">
            <link rel="stylesheet" href="/_assets/styles/register.css">
            <link rel="stylesheet" href="/_assets/styles/login.css">
            <link rel="stylesheet" href="/_assets/styles/legalnotice.css">
            <link rel="stylesheet" href="/_assets/styles/sitemap.css">
            <link rel="stylesheet" href="/_assets/styles/homepage.css">
            <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
            <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.css"/>
            <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.Default.css"/>
            <link rel="stylesheet" href="/_assets/styles/map.css"/>
            <!-- Meta pour l'affichage réseaux sociaux -->
            <meta property="og:title" content="{$smTitle}">
            <meta property="og:description" content="{$smDescription}">
            <meta property="og:image" content="{$smImage}">
            <meta property="og:url" content="{$smUrl}">
            <link rel="icon" href="/favicon.ico" type="image/x-icon">
            <!-- Import Font Inter, Noto Serif & Quicksand -->
            <link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link
                href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Noto+Serif:ital,wght@0,100..900;1,100..900&family=Quicksand:wght@300..700&display=swap"
                rel="stylesheet"
            >
        </head>
        <body id="top">
            <header class="header">
                <div class="header-brand">
                    <a href="/" class="btn-accueil">PFAS-EXPLORER</a>
                </div>
                <!-- Menu -->
                <nav id="buttonnav" aria-label="Navigation principale">
                    {$nav}
                </nav>
            </header>
        
        <main>
            {$contenu}
        </main>
        
        <footer>
            <div class="footer-container">
                <div class="footer-description">
                    <h3 class="title-footer">PFAS-EXPLORER</h3>
                    <p>
                        PFAS-Explorer est une application web cartographique permettant d'explorer les contaminations
                        aux PFAS et de gérer des espaces de travail et des données environnementales.
                    </p>
                </div>
                <div class="footer-nav-col">
                    <h4 class="footer-subtitle">Navigation</h4>
                    <div class="footer-hyperlinks">
                        <a href="/" class="footer-link">Accueil</a>
                        <a href="/legalnotice" class="footer-link">Mentions Légales</a>
                        <a href="/sitemap" class="footer-link">Plan du site</a>
                    </div>
                </div>
                <div class="footer-meta-col">
                    <p class="footer-copy">© 2026 - Tous droits réservés</p>
                    <a href="#top" class="footer-link return-top" title="Retour en haut de page" aria-label="Retour en haut de page">↑</a>
                </div>
            </div>
        </footer>
        </body>
        </html>
        HTML;
    }
}