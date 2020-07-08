<?php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
    integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
    crossorigin=""/>
    <link rel="stylesheet" href="css.css">
    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
    integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
    crossorigin=""></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

    <!-- MarkerClusters... -->
    <!-- https://unpkg.com/leaflet.markercluster@1.4.1/dist/ -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.4.1/dist/MarkerCluster.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.4.1/dist/MarkerCluster.Default.css">
    <script src="https://unpkg.com/leaflet.markercluster@1.4.1/dist/leaflet.markercluster.js"></script>
    <title>vcoemap</title>


</head>
<body>
    
    <div><p>Hello Map!</p></div>

    <div id="mapid"></div>

<script>

    //var mymap = L.map('mapid').setView([51.505, -0.09], 13);

    // L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
    // attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
    // maxZoom: 18,
    // id: 'mapbox/streets-v11',
    // tileSize: 512,
    // zoomOffset: -1,
    // accessToken: 'pk.eyJ1IjoibWFwcGVuaGVpbWVyIiwiYSI6ImNrMDJxaGltYzFoeWszYnBkbzd4amgxOGMifQ.jm6QRmXrLzHJBPBJ4SOWXA'
    // }).addTo(mymap);

    var littleton = L.marker([47.312759, 12.420044]).bindPopup('This is Littleton, CO.'),
    denver    = L.marker([48.239309, 15.441284]).bindPopup('This is Denver, CO.'),
    aurora    = L.marker([48.629278, 12.090454]).bindPopup('This is Aurora, CO.'),
    golden    = L.marker([48.432845, 10.283203]).bindPopup('This is Golden, CO.');

    var cities = L.layerGroup([littleton, denver, aurora, golden]);

    var markers = L.markerClusterGroup();
    
    markers.addLayer(L.marker(getRandomLatLng(map)));
    
    map.addLayer(markers);

	var mbAttr = 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
	    '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
		'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
		mbUrl = 'https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw';


    var grayscale = L.tileLayer(mbUrl, 
                                {
                                    id: 'mapbox/light-v9', 
                                    tileSize: 512, 
                                    zoomOffset: -1, 
                                    attribution: mbAttr,
                                    minZoom: 8
                                }
                                );

    var streets   = L.tileLayer(mbUrl, 
                                {id: 'mapbox/streets-v11', 
                                    tileSize: 512, 
                                    zoomOffset: -1, 
                                    attribution: mbAttr,
                                    minZoom: 8
                                }
                                );

    var mymap = L.map('mapid', {
        center: [47.661688,13.090210],
        zoom: 8,
        layers: [grayscale, cities]
    });

    var baseMaps = {
        "Grayscale": grayscale,
        "Streets": streets
    };  

    var overlayMaps = {
        "Cities": cities
    };

    L.control.layers(baseMaps, overlayMaps).addTo(mymap);

    var baseMaps = {
    "<span style='color: gray'>Grayscale</span>": grayscale,
    "Streets": streets
    };

    mymap.on('click', function(e) {
        //alert(e.latlng);
        
        //Marker
        L.marker(e.latlng).addTo(mymap);
        
        //Popup
        var popup = L.popup()
        .setLatLng(e.latlng)
        .setContent(
            '<h3>Schau mal!</h3><br /><p>This is a nice popup at...' + e.latlng + '</p><form action="#" method="post"><div class="form-group"><input type="text" class="form-control" id="text1"><br /><br /><textarea type="text" class="form-control" id="text2" rows="3"></textarea><br /><br /><button type="submit" class="btn btn-primary mb-2">Eintrag bestätigen</button></div></form>'
        )
        .openOn(mymap);

    });

</script>



</body>
</html>