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

function printDot(p) {
    L.circleMarker(p, {radius: 4, color: '#ffffff', weight: 1, fillColor: '#d62828', fillOpacity: 0.8}).addTo(layer);
}

function sortDot(p) {
    return(dots);
}

function refresh() {
    layer.clearLayers();
    dots.forEach(printDot);
}

map.on('moveend', refresh);
refresh(); 