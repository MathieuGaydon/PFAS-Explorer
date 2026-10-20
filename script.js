//bloc js donné par leaflet
var map = L.map('map').setView([32.080881, 34.780569], 7);
L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo(map);

//liste des points, à modifier pour contenir tous les point que l'on veut afficher
var dots = [
    [32.080881, 34.780569],
    [31.768319, 35.213710],
    [32.794044, 34.989571],
    [31.252973, 34.791462],
    [32.916667, 35.5]
];

var layer = L.layerGroup().addTo(map);

//imprime le point de coordonnée p sur la carte
function printDot(p) {
    L.circleMarker(p, {radius: 4, color: '#ffffff', weight: 1, fillColor: '#d62828', fillOpacity: 0.8}).addTo(layer);
}

//fonction qui nettoie la carte des points affichés et re-imprime tout
function refresh() {
    layer.clearLayers();
    //on met à jours les coordonnées visibles à l'écran
    var bounds = map.getBounds();
    var minLat = bounds.getSouth();
    var maxLat = bounds.getNorth();
    var minLong  = bounds.getWest();
    var maxLong  = bounds.getEast();
    dots.forEach(printDot);
}

//on rafraichis la carte a chaque mouvement
map.on('moveend', refresh);
refresh(); 