<?php
spl_autoload_register(function (string $classe): void {
    $prefixe = 'App\\';
    if (!str_starts_with($classe, $prefixe)) {
        return;                                   // ne nous concerne pas donc on le laisse à main
    }
    $relatif = substr($classe, strlen($prefixe)); // exemple : Model\UserRepository
    $fichier = __DIR__ . '/src/' . str_replace('\\', '/', $relatif) . '.php';
    if (is_file($fichier)) {
        require $fichier;
    }
});