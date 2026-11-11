<?php

namespace App\Controller;

use App\Core\Request;
use App\Core\Response;

final class MapController
{
    public function dots(Request $request): Response
    {
        $minLat  = (float) $request->get('minLat');
        $maxLat  = (float) $request->get('maxLat');
        $minLong = (float) $request->get('minLong');
        $maxLong = (float) $request->get('maxLong');

        //liste des points imprimés, rajouter une requete SQL pour récupérer 
        // les points dans la base de données selon les coordonnées 
        // visibles à l'écran donné par les variables $minLat, $maxLat, 
        // $minLong, $maxLong
        $dots = [
            ['dotId' => 1, 'lat' => 32.080881, 'long' => 34.780569],
            ['dotId' => 2, 'lat' => 31.768319, 'long' => 35.213710],
            ['dotId' => 3, 'lat' => 32.794044, 'long' => 34.989571],
            ['dotId' => 4, 'lat' => 31.252973, 'long' => 34.791462],
            ['dotId' => 5, 'lat' => 32.916667, 'long' => 35.5],
        ];

        return Response::json($dots);
    }
}