//bloc js donné par leaflet
var map = L.map('map').setView([32.080881, 34.780569], 7);
L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo(map);

var layer = L.layerGroup().addTo(map);

//imprime le point de coordonnée p sur la carte
function printDot(p) {
    L.circleMarker(p, {radius: 4, color: '#ffffff', weight: 1, fillColor: '#d62828', fillOpacity: 0.8}).addTo(layer).on('mouseover', getInfo);
}

function getInfo(e) {
    alert("MAGIQUE !");
}

//fonction qui nettoie la carte des points affichés et re-imprime tout
async function refresh() {
    //on met à jours les coordonnées visibles à l'écran
    var bounds = map.getBounds();
    var minLat = bounds.getSouth();
    var maxLat = bounds.getNorth();
    var minLong  = bounds.getWest();
    var maxLong  = bounds.getEast();
    var url = 'controller.php'+'?minLat='+minLat+'&maxLat='+maxLat+'&minLong='+minLong+'&maxLong='+maxLong;
    //attend le traitement de la requête et récupère le résultat en json
    var dots = await (await fetch(url)).json();
    layer.clearLayers();
    dots.forEach(printDot);
}

//on rafraichis la carte a chaque mouvement
map.on('moveend', refresh);
refresh(); 