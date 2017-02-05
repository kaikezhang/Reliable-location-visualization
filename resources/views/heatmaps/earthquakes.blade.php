<!DOCTYPE html>
<html>
  <head>
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>
  </head>
  <body>
    <div id="map"></div>
    <script>
      var map;
      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
        center: new google.maps.LatLng(38.8833, -98.0167),
        disableDefaultUI: true,
        styles: [{
            'featureType': 'all',
            'elementType': 'geometry.fill',
            'stylers': [{ 'weight': '2.00' }]
        }, {
            'featureType': 'all',
            'elementType': 'geometry.stroke',
            'stylers': [{ 'color': '#9c9c9c' }]
        }, {
            'featureType': 'all',
            'elementType': 'labels.text',
            'stylers': [{ 'visibility': 'off' }]
        }, {
            'featureType': 'administrative.locality',
            'elementType': 'labels.text',
            'stylers': [{ 'visibility': 'on' }]
        }, {
            'featureType': 'landscape',
            'elementType': 'all',
            'stylers': [{ 'color': '#f2f2f2' }]
        }, {
            'featureType': 'landscape',
            'elementType': 'geometry.fill',
            'stylers': [{ 'color': '#ffffff' }]
        }, {
            'featureType': 'landscape.man_made',
            'elementType': 'geometry.fill',
            'stylers': [{ 'color': '#ffffff' }]
        }, {
            'featureType': 'poi',
            'elementType': 'all',
            'stylers': [{ 'visibility': 'off' }]
        }, {
            'featureType': 'road',
            'elementType': 'all',
            'stylers': [{ 'saturation': -100 }, { 'lightness': 45 }]
        }, {
            'featureType': 'road',
            'elementType': 'geometry.fill',
            'stylers': [{ 'color': '#eeeeee' }]
        }, {
            'featureType': 'road',
            'elementType': 'labels.text.fill',
            'stylers': [{ 'color': '#7b7b7b' }]
        }, {
            'featureType': 'road',
            'elementType': 'labels.text.stroke',
            'stylers': [{ 'color': '#ffffff' }]
        }, {
            'featureType': 'road.highway',
            'elementType': 'all',
            'stylers': [{ 'visibility': 'simplified' }]
        }, {
            'featureType': 'road.arterial',
            'elementType': 'labels.icon',
            'stylers': [{ 'visibility': 'off' }]
        }, {
            'featureType': 'transit',
            'elementType': 'all',
            'stylers': [{ 'visibility': 'off' }]
        }, {
            'featureType': 'water',
            'elementType': 'all',
            'stylers': [{ 'color': '#46bcec' }, { 'visibility': 'on' }]
        }, {
            'featureType': 'water',
            'elementType': 'geometry.fill',
            'stylers': [{ 'color': '#c8d7d4' }]
        }, {
            'featureType': 'water',
            'elementType': 'labels.text.fill',
            'stylers': [{ 'color': '#070707' }]
        }, {
            'featureType': 'water',
            'elementType': 'labels.text.stroke',
            'stylers': [{ 'color': '#ffffff' }]
        }],
        zoom: 4
        });

        // Create a <script> tag and set the USGS URL as the source.
        var script = document.createElement('script');

        // This example uses a local copy of the GeoJSON stored at
        // http://earthquake.usgs.gov/earthquakes/feed/v1.0/summary/2.5_week.geojsonp
        // script.src = 'http://earthquake.usgs.gov/earthquakes/feed/v1.0/summary/2.5_week.geojsonp';
        // http://earthquake.usgs.gov/fdsnws/event/1/query?format=geojson&starttime=2000-01-01&endtime=2017-01-01&minmagnitude=5&minlatitude=10&maxlatitude=60&minlongitude=-160&maxlongitude=-30
        script.src = '{{asset('data/2000-2017-5.geojsonp')}}';
        document.getElementsByTagName('head')[0].appendChild(script);

      }

      function eqfeed_callback(results) {
        var heatmapData = [];
        for (var i = 0; i < results.features.length; i++) {
          var coords = results.features[i].geometry.coordinates;
          var latLng = new google.maps.LatLng(coords[1], coords[0]);
          heatmapData.push(latLng);
        }
        var heatmap = new google.maps.visualization.HeatmapLayer({
          data: heatmapData,
          dissipating: false,
          map: map
        });
        heatmap.set('radius',  6);
      }
    </script>
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBj6Nk45Ze1yvmDH4lCFrDBDsNiY5_cHnQ&libraries=visualization&callback=initMap">
    </script>
  </body>
</html>