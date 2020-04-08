
// function onMapClick(e) {
//     alert("You clicked the map at " + e.latlng);
// }

// mymap.on('click', onMapClick);


var huyenDauTieng = L.geoJson(dautieng, {
    // onEachFeature: function (feature, layer)
    // {
    //     layer.bindPopup('<div style="font-weight: bold;"></div>');
    // },
    color: '#555555',
    fillColor: '#8080ff',
    fillOpacity: 0.3,
    radius: 500
}).addTo(mymap);

var huyenBauBang = L.geoJson(baubang, {
    
    color: '#555555',
    fillColor: '#8080ff',
    fillOpacity: 0.3,
    radius: 500
}).addTo(mymap);

var thixaBenCat = L.geoJson(bencat, {
    
    color: '#555555',
    fillColor: '#8080ff',
    fillOpacity: 0.3,
    radius: 500
}).addTo(mymap);

var tpThuDauMot = L.geoJson(thudaumot, {
    color: '#555555',
    fillColor: '#8080ff',
    fillOpacity: 0.3,
    radius: 500
}).addTo(mymap);

var thixaThuanAn = L.geoJson(thuanan, {
    color: '#555555',
    fillColor: '#8080ff',
    fillOpacity: 0.3,
    radius: 500
}).addTo(mymap);

var thixaDiAn = L.geoJson(dian, {
    color: '#555555',
    fillColor: '#8080ff',
    fillOpacity: 0.3,
    radius: 500
}).addTo(mymap);

var thixaTanUyen = L.geoJson(tanuyen, {
    color: '#555555',
    fillColor: '#8080ff',
    fillOpacity: 0.3,
    radius: 500
}).addTo(mymap);

var huyenPhuGiao = L.geoJson(phugiao, {
    color: '#555555',
    fillColor: '#8080ff',
    fillOpacity: 0.3,
    radius: 500
}).addTo(mymap);

var huyenBacTanUyen = L.geoJson(bactanuyen, {
    color: '#555555',
    fillColor: '#8080ff',
    fillOpacity: 0.3,
    radius: 500
}).addTo(mymap);



