
var mymap;
var marker;
var locationinfo;
function initMap() {
	var lat = 51.505;
	var lng = -0.09;
		mymap = L.map('mapid').setView([lat, lng], 13);
		L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
		attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
		maxZoom: 18,
		id: 'mapbox/streets-v11',
		tileSize: 512,
		zoomOffset: -1,
		accessToken: 'pk.eyJ1IjoicGF2ZW5sb2wiLCJhIjoiY2tkM2UxNnJ5MW14MjMxbXZmanlqYmliciJ9.nEYvQomSCCA7hXS-Avo05Q'
	}).addTo(mymap);	
}

function editMap(data) {
	
	lat = data['0']['lat'];
	lng = data['0']['lng'];
	if (marker) { mymap.removeLayer(marker); }
	mymap.setView(new L.LatLng(lat, lng), 11, { animation: true }); 
	marker = L.marker(new L.LatLng(lat, lng));
	marker.bindTooltip(data[0]['name'], {permanent: true, className: "my-label", offset: [0, 0] });
	mymap.addLayer(marker);
	
}
