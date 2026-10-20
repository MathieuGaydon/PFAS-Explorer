<?php
$minLat  = (float) $_GET['minLat'];
$maxLat  = (float) $_GET['maxLat'];
$minLong = (float) $_GET['minLong'];
$maxLong = (float) $_GET['maxLong'];

//liste des points imprimés, rajouter une requete SQL pour récupérer 
// les points dans la base de données selon les coordonnées 
// visibles à l'écran donné par les variables $minLat, $maxLat, 
// $minLong, $maxLong
$dots = [
    [32.080881, 34.780569],
    [31.768319, 35.213710],
    [32.794044, 34.989571],
    [31.252973, 34.791462],
    [32.916667, 35.5],
];

echo json_encode($dots);
?>
