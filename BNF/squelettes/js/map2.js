var mymap2 = L.map('map2', {
    center: [0, 0],
    zoom: 2,
    scrollWheelZoom: false,
});

mymap2.once('focus', function() {
    mymap2.scrollWheelZoom.enable();
});
mymap2.on('focus', function() {
    mymap2.scrollWheelZoom.enable();
});
mymap2.on('blur', function() {
    mymap2.scrollWheelZoom.disable();
});

//add markerColor
var userMarker = L.AwesomeMarkers.icon({
    icon: 'user',
    prefix: 'fa',
    markerColor: 'darkblue',
});

mymap2.on('click', onMapClick);

var arrMarker = [];

function onMapClick(e) {
    var n = arrMarker.length+1;
    var id = "mAjout"+n;
    var html = "Marker "+id;

var form = '<form class="pure-form pure-form-aligned">'+
'<form class="well form-horizontal" action="#CHEMIN{handlingData.php}" method="GET"  id="creer">'+
'<fieldset>'+
'<input type="hidden" value="" id="latlng" />'+
'<div class="pure-control-group">'+
'<label for="category">Catégorie</label>'+
"<select name='category'>"+
"<option value=' ' >Choisissez une catégorie</option>"+
"<option>Aventure</option>"+
"<option>Voyage</option>"+
"<option >Anecdote</option>"+
"<option >Cuisine</option>"+
"<option >Histoire</option>"+
"<option >Informations</option>"+
"<option >Avis</option>"+
"</select>"+
'</div>'+
'<div class="pure-control-group">'+
'<label for="commentaire">Commentaire</label>'+
'<textarea id="annotation" placeholder="Entrez votre commentaire ici..."></textarea>'+
'</div>'+
'<input name="creer" type="submit" value="Publier" class="pure-button pure-button-primary"">'+
'</fieldset>'+
'</form>';

    marker = new L.marker(e.latlng, {id:id, draggable:'true',icon: userMarker}).bindPopup(form);
    var position = marker.getLatLng();
    console.log(id, position);
    arrMarker.push(marker);
      marker.on('dragend', function(event){
            var marker = event.target;
            var position = marker.getLatLng();
            console.log(id, position);
            marker.setLatLng(position,{id:id,draggable:'true'}).bindPopup(form).update();
    });
    mymap2.addLayer(marker);
};

if (typeof position !== 'undefined') {
  document.getElementById('latlng').value = position;
}




L.tileLayer.iiif('http://gallica.bnf.fr/iiif/ark:/12148/btv1b53090003b/f1/info.json', {
    scrollWheelZoom: 'false',
    minZoom: 2,
    maxZoom: 6,
}).addTo(mymap2);
