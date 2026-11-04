<?php

namespace App\View;

final class LogoutForm extends Component
{
    public function render(): string
    {
        return <<<HTML
        <form action="/logout" method="post" class="logout-form">
            <button type="submit" class="inside logout-button">Déconnexion</button>
        </form>
        HTML;
    }
}