var mymap = L.map('map1', {
    center: [0, 0],
    zoom: 2,
    scrollWheelZoom: false,
});

mymap.once('focus', function() {
    mymap.scrollWheelZoom.enable();
});
mymap.on('focus', function() {
    mymap.scrollWheelZoom.enable();
});
mymap.on('blur', function() {
    mymap.scrollWheelZoom.disable();
});


L.tileLayer.iiif('http://gallica.bnf.fr/iiif/ark:/12148/btv1b550070757/f1/info.json', {
    scrollWheelZoom: 'false',
    minZoom: 2,
    maxZoom: 6,
}).addTo(mymap);

var redMarker = L.AwesomeMarkers.icon({
    icon: 'info-circle',
    prefix: 'fa',
    markerColor: 'darkred',
});

L.marker([80.82, -65.90], {
        icon: redMarker,
    })
    .addTo(mymap)
    .bindPopup("Départ du port de Saint-Malo le 20 avril 1534. Jacques Cartier est à la tête d'une expédition composée de deux petits navires et d'une soixantaine d'hommes.");

L.marker([82.89, -160.13], {
        icon: redMarker,
    })
    .addTo(mymap)
    .bindPopup("L'expédition arrive dans le golfe du Saint-Laurent");

var curve = L.curve(['M', [80.82, -65.90],
    'Q', [81.50, -90.50],
    [79.70, -110.90],
    'T', [82.89, -160.13]
], {
    color: 'darkred',
    dashArray: 8,
    animate: {
        duration: 3000,
        iterations: Infinity
    }
}).addTo(mymap);


var popup = L.popup();

function onMapClick(e) {
    popup
        .setLatLng(e.latlng)
        .setContent("You clicked the map at " + e.latlng.toString())
        .openOn(mymap);
}

mymap.on('click', onMapClick);
