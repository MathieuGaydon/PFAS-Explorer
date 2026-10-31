<?php
namespace App\View;

final class SiteMap extends Component {
    public function render(): string {
        return <<<HTML
        <div class="sitemap">
            <h2>Plan du site</h2>
            <ul>
                <li><a href="/" class="sitemap-link">Accueil</a></li>
                <li><a href="/register" class="sitemap-link">Inscription</a></li>
                <li><a href="/login" class="sitemap-link">Authentification</a></li>
                <li><a href="/legalnotice" class="sitemap-link">Mentions légales</a></li>
                <li><a href="/sitemap" class="sitemap-link">Plan du site</a></li>
            </ul>
        </div>
        HTML;

    }
}