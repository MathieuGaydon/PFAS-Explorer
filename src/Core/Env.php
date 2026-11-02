<?php
namespace App\Core;

final class Env
{
    private static array $variables = [];
    public static function charger(string $chemin): void
    {
        // vérifie l'existence du fichier
        if (!is_file($chemin)) {
            return;
        }

        // parcourt du fichier
        $lignes = file($chemin, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lignes as $ligne) {
            $ligne = trim($ligne);

            // ignore les commentaires
            if ($ligne === '' || str_starts_with($ligne, '#')) {
                continue;
            }

            // découpage en 2 parties sur '='
            $parties = explode('=', $ligne, 2);
            if (count($parties) === 2) {
                $cle = trim($parties[0]);
                $valeur = trim($parties[1]);

                // retirer les guillemets
                $valeur = trim($valeur, '"\'');

                self::$variables[$cle] = $valeur;

                $_ENV[$cle] = $valeur;
                putenv("$cle=$valeur");
            }
        }
    }

    public static function get(string $cle, ?string $defaut = null): ?string
    {
        $valeur = self::$variables[$cle] ?? $_ENV[$cle] ?? getenv($cle); // le fichier .env, sinon l'environnement du système

        return $valeur === false ? $defaut : $valeur;
    }
}