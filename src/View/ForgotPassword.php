<?php

namespace App\View;

final class ForgotPassword extends Component
{
    public function __construct(
        private readonly array $erreurs,
        private readonly string $email
    ) {
    }

    public function render(): string
    {
        $erreursHtml = '';
        if (!empty($this->erreurs)) {
            $erreursHtml = '<div class="form-errors"><ul>';
            foreach ($this->erreurs as $erreur) {
                $erreursHtml .= '<li>' . $this->e($erreur) . '</li>';
            }
            $erreursHtml .= '</ul></div>';
        }

        $emailSafe = $this->e($this->email);

        return <<<HTML
        <div class="forgot-password">
            <h2>Mot de passe oublié</h2>
            {$erreursHtml}
            <form action="/forgot-password" method="post">
                <p class="form-info">Saisissez l'adresse email de votre compte. Nous vous enverrons un code de vérification.</p>
                <div>
                    <label for="email">E-mail :</label>
                    <input type="email" id="email" name="email" placeholder="mail@exemple.com" value="{$emailSafe}" required>
                </div>
                <div>
                    <input type="submit" value="Envoyer le code">
                </div>
            </form>
        </div>
        HTML;
    }
}