<?php

namespace App\View\Component;

final class MapView extends Component
{
    public function render(): string
    {
        return <<<HTML
        <div id="main-content">
            <div id="map"></div>
            <div id="info"> 
                <h2>Point sélectionné :</h2>
                <ul>
                    <li id="dotName"></li>
                    <li id="lat"></li>
                    <li id="long"></li>
                </ul>
            </div>
        </div>
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
        <script src="https://unpkg.com/leaflet.markercluster@1.5.3/dist/leaflet.markercluster.js"></script>
        <script src="/_assets/scripts/map.js" defer></script>
        HTML;
    }
}