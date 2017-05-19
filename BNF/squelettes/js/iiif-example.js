var map, stanfordMlk, apostle, princetonMap, bnf, iiifLayers, scottlandBagpipe;

map = L.map('map', {
  center: [0, 0],
  crs: L.CRS.Simple,
      minZoom: 2,
  maxZoom: 5,
      zoom: 4,
      scrollWheelZoom: false
});

 map.once('focus', function() { map.scrollWheelZoom.enable(); });
 map.on('focus', function() { map.scrollWheelZoom.enable(); });
 map.on('blur', function() { map.scrollWheelZoom.disable(); });

 map.on('click', onMapClick);

var arrMarker = [];

function onMapClick(e) {
    var n = arrMarker.length+1;
    var id = "mAjout"+n;

    var html = "Marker "+id;

    marker = new L.marker(e.latlng, {id:id, draggable:'true'}).bindPopup('<form class="pure-form pure-form-aligned">'+
'<form class="well form-horizontal" action="#CHEMIN{marker.php}" method="post"  id="contact_form">'+
'    <fieldset>'+
'        <div class="pure-control-group">'+
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
'        </div>'+
/*'        <div class="pure-control-group">'+
'            <label for="name">Username</label>'+
'            <input id="name" type="text" placeholder="Username">'+
'            <span class="pure-form-message-inline">This is a required field.</span>'+
'        </div>'+
'        <div class="pure-control-group">'+
'            <label for="password">Password</label>'+
'            <input id="password" type="password" placeholder="Password">'+
'        </div>'+
'        <div class="pure-control-group">'+
'            <label for="email">Email Address</label>'+
'            <input id="email" type="email" placeholder="Email Address">'+
'        </div>'+*/
'        <div class="pure-control-group">'+
'            <label for="commentaire">Commentaire</label>'+
'            <textarea id="commentaire" placeholder="Entrez votre commentaire ici..."></textarea>'+
'        </div>'+
'<input name="creer" type="submit" value="Publier" class="pure-button pure-button-primary"">'+
/*'        <div class="pure-controls">'+
'            <label for="cb" class="pure-checkbox">'+
'                <input id="cb" type="checkbox"> Ive read the terms and conditions'+
'            </label>'+
'            <button type="submit" class="pure-button pure-button-primary">Submit</button>'+
'        </div>'+*/
'    </fieldset>'+
'</form>');
    arrMarker.push(marker);
      marker.on('dragend', function(event){
            var marker = event.target;
            var position = marker.getLatLng();
            console.log(position);
            marker.setLatLng(position,{id:id,draggable:'true'}).bindPopup(html).update();
    });
    map.addLayer(marker);
};

stanfordMlk = L.tileLayer.iiif('http://gallica.bnf.fr/iiif/ark:/12148/btv1b550070757/f1/info.json', {
  attribution: '<a href="http://gallica.bnf.fr/iiif/ark:/12148/btv1b550070757">World map</a>',
  maxZoom: 5
}).addTo(map);

princetonMap = L.tileLayer.iiif('http://libimages.princeton.edu/loris2/pudl0076%2Fmap_pownall%2F00000001.jp2/info.json', {
  attribution: '<a href="http://arks.princeton.edu/ark:/88435/02870w62c">The provinces of New York and New Jersey, with part of Pensilvania, and the Province of Quebec : drawn by Major Holland, Surveyor General, of the Northern District in America. Corrected and improved, from the original materials, by Governr. Pownall, Member of Parliament, 1776</a>'
});

apostle = L.tileLayer.iiif('http://ids.lib.harvard.edu/ids/iiif/25286610/info.json', {
  attribution: '<a href="http://via.lib.harvard.edu/via/deliver/deepcontentItem?recordId=olvwork576793%2CVIT.BB%3A4906794">Apostle: Anonymous sculptor of Florence, 15th century (1401-1500)</a>'
});

bnf = L.tileLayer.iiif('http://gallica.bnf.fr/iiif/ark:/12148/btv1b84539771/f1/info.json', {
  attribution: '<a href="http://gallicalabs.bnf.fr/ark:/12148/btv1b84539771">ManuscritKalîla et Dimna, avec de nombreuses',
  fitBounds: false
});

acrobata = L.tileLayer.iiif('http://libimages.princeton.edu/loris2/pudl0033/2007/04003/00000001.jp2/info.json', {
  attribution: '<a href="http://pudl.princeton.edu/objects/pz50gw22j">Acrobata Marroquí - Lorenzo Homar</a>',
  quality: 'gray'
});

scottlandBagpipe = L.tileLayer.iiif('http://images.is.ed.ac.uk/luna/servlet/iiif/UoEwmm~2~2~77099~164515/info.json');

staticTiles = L.tileLayer.iiif('http://evil-manifests.davidnewbury.com/iiif/images/garden-1/info.json');

iiifLayers = {
  'blabla': stanfordMlk,
  'The provinces of New York and N...': princetonMap,
  'Apostle: Anonymous sculptor of Fl...': apostle,
  'ManuscritKalîla et Dimna, avec de...': bnf,
  'Acrobata Marroquí': acrobata,
  'A static tile source': staticTiles,
  'A Compleat Theory of the Scots Highland Bagpipe': scottlandBagpipe
};

L.control.layers(iiifLayers).addTo(map);


L.marker([-40.5, 35.09]).addTo(map)
 .bindPopup('it works motherfucker');


L.marker([-51.941196,40.512291], {icon: L.AwesomeMarkers.icon({icon: 'coffee', markerColor: 'red', prefix: 'fa', spin:true}) }).addTo(map);

 /*
  * Leaflet.curve v0.1.0 - a plugin for Leaflet mapping library. https://github.com/elfalem/Leaflet.curve
  * (c) elfalem 2015
  */
 /*
  * note that SVG (x, y) corresponds to (long, lat)
  */

 L.Curve = L.Path.extend({
 	options: {
 	},

 	initialize: function(path, options){
 		L.setOptions(this, options);
 		this._initialUpdate = true;
 		this._setPath(path);
 	},

 	getPath: function(){
 		return this._coords;
 	},

 	setPath: function(path){
 		this._setPath(path);
 		return this.redraw();
 	},

 	getBounds: function() {
 		return this._bounds;
 	},

 	_setPath: function(path){
 		this._coords = path;
 		this._bounds = this._computeBounds();
 	},

 	_computeBounds: function(){
 		var bound = new L.LatLngBounds();
 		var lastPoint;
 		var lastCommand;
 		var coord;
 		for(var i = 0; i < this._coords.length; i++){
 			coord = this._coords[i];
 			if(typeof coord == 'string' || coord instanceof String){
 				lastCommand = coord;
 			}else if(lastCommand == 'H'){
 				bound.extend([lastPoint.lat,coord[0]]);
 				lastPoint = new L.latLng(lastPoint.lat,coord[0]);
 			}else if(lastCommand == 'V'){
 				bound.extend([coord[0], lastPoint.lng]);
 				lastPoint = new L.latLng(coord[0], lastPoint.lng);
 			}else if(lastCommand == 'C'){
 				var controlPoint1 = new L.latLng(coord[0], coord[1]);
 				coord = this._coords[++i];
 				var controlPoint2 = new L.latLng(coord[0], coord[1]);
 				coord = this._coords[++i];
 				var endPoint = new L.latLng(coord[0], coord[1]);

 				bound.extend(controlPoint1);
 				bound.extend(controlPoint2);
 				bound.extend(endPoint);

 				endPoint.controlPoint1 = controlPoint1;
 				endPoint.controlPoint2 = controlPoint2;
 				lastPoint = endPoint;
 			}else if(lastCommand == 'S'){
 				var controlPoint2 = new L.latLng(coord[0], coord[1]);
 				coord = this._coords[++i];
 				var endPoint = new L.latLng(coord[0], coord[1]);

 				var controlPoint1 = lastPoint;
 				if(lastPoint.controlPoint2){
 					var diffLat = lastPoint.lat - lastPoint.controlPoint2.lat;
 					var diffLng = lastPoint.lng - lastPoint.controlPoint2.lng;
 					controlPoint1 = new L.latLng(lastPoint.lat + diffLat, lastPoint.lng + diffLng);
 				}

 				bound.extend(controlPoint1);
 				bound.extend(controlPoint2);
 				bound.extend(endPoint);

 				endPoint.controlPoint1 = controlPoint1;
 				endPoint.controlPoint2 = controlPoint2;
 				lastPoint = endPoint;
 			}else if(lastCommand == 'Q'){
 				var controlPoint = new L.latLng(coord[0], coord[1]);
 				coord = this._coords[++i];
 				var endPoint = new L.latLng(coord[0], coord[1]);

 				bound.extend(controlPoint);
 				bound.extend(endPoint);

 				endPoint.controlPoint = controlPoint;
 				lastPoint = endPoint;
 			}else if(lastCommand == 'T'){
 				var endPoint = new L.latLng(coord[0], coord[1]);

 				var controlPoint = lastPoint;
 				if(lastPoint.controlPoint){
 					var diffLat = lastPoint.lat - lastPoint.controlPoint.lat;
 					var diffLng = lastPoint.lng - lastPoint.controlPoint.lng;
 					controlPoint = new L.latLng(lastPoint.lat + diffLat, lastPoint.lng + diffLng);
 				}

 				bound.extend(controlPoint);
 				bound.extend(endPoint);

 				endPoint.controlPoint = controlPoint;
 				lastPoint = endPoint;
 			}else{
 				bound.extend(coord);
 				lastPoint = new L.latLng(coord[0], coord[1]);
 			}
 		}
 		return bound;
 	},

 	//TODO: use a centroid algorithm instead
 	getCenter: function () {
 		return this._bounds.getCenter();
 	},

 	_update: function(){
 		if (!this._map) { return; }

 		this._updatePath();
 	},

 	_updatePath: function() {
 		this._renderer._updatecurve(this);
 	},

 	_project: function() {
 		var coord, lastCoord, curCommand, curPoint;

 		this._points = [];

 		for(var i = 0; i < this._coords.length; i++){
 			coord = this._coords[i];
 			if(typeof coord == 'string' || coord instanceof String){
 				this._points.push(coord);
 				curCommand = coord;
 			}else {
 				switch(coord.length){
 					case 2:
 						curPoint = this._map.latLngToLayerPoint(coord);
 						lastCoord = coord;
 					break;
 					case 1:
 						if(curCommand == 'H'){
 							curPoint = this._map.latLngToLayerPoint([lastCoord[0], coord[0]]);
 							lastCoord = [lastCoord[0], coord[0]];
 						}else{
 							curPoint = this._map.latLngToLayerPoint([coord[0], lastCoord[1]]);
 							lastCoord = [coord[0], lastCoord[1]];
 						}
 					break;
 				}
 				this._points.push(curPoint);
 			}
 		}
 	}
 });

 L.curve = function (path, options){
 	return new L.Curve(path, options);
 };

 L.SVG.include({
 	_updatecurve: function(layer){
 		this._setPath(layer, this._curvePointsToPath(layer._points));

 		if(layer.options.animate){
 			var path = layer._path;
 			var length = path.getTotalLength();

 			if(!layer.options.dashArray){
 				path.style.strokeDasharray = length + ' ' + length;
 			}

 			if(layer._initialUpdate){
 				path.animate([
 						{strokeDashoffset: length},
 						{strokeDashoffset: 0}
 					], layer.options.animate);
 				layer._initialUpdate = false;
 			}
 		}
 	},

  	_curvePointsToPath: function(points){
 		var point, curCommand, str = '';
 		for(var i = 0; i < points.length; i++){
 			point = points[i];
 			if(typeof point == 'string' || point instanceof String){
 				curCommand = point;
 				str += curCommand;
 			}else{
 				switch(curCommand){
 					case 'H':
 						str += point.x + ' ';
 						break;
 					case 'V':
 						str += point.y + ' ';
 						break;
 					default:
 						str += point.x + ',' + point.y + ' ';
 						break;
 				}
 			}
 		}
 		return str || 'M0 0';
 	}
 });


 var path2 = L.curve(['M',[-60.54136296522163,38.520507812500004],
          'C',[-34.214338608258224,28.564453125000004],
            [-40.45835188280866,13.57421875000001],
            [-46.680797145321655,11.83789062500001]],
          {color:'darkred',fill:false, animate: 3000}).addTo(map);

var path = L.curve(['M',[-50.14874640066278,14.106445312500002],
				   'Q',[-51.67255514839676,16.303710937500004],
					   [-50.14874640066278,18.676757812500004],
				   'T',[-49.866316729538674,25.0927734375]], {dashArray: 5, animate: {duration: 3000, iterations: Infinity}}) .addTo(map);
