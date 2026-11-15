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
            ['dotId' => 1, 'dotName' => 'Paris',     'lat' => 48.856614, 'long' => 2.352222],
            ['dotId' => 2, 'dotName' => 'Lyon',      'lat' => 45.764043, 'long' => 4.835659],
            ['dotId' => 3, 'dotName' => 'Marseille', 'lat' => 43.296482, 'long' => 5.369780],
            ['dotId' => 4, 'dotName' => 'Bordeaux',  'lat' => 44.837789, 'long' => -0.579180],
            ['dotId' => 5, 'dotName' => 'Lille',     'lat' => 50.629250, 'long' => 3.057256],
        ];

        return Response::json($dots);
    }
}