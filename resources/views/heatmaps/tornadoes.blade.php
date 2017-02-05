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
        // http://www.spc.noaa.gov/wcm/data/Actual_tornadoes.csv
        script.src = '{{asset('data/tornadoes.cvs')}}';
        document.getElementsByTagName('head')[0].appendChild(script);

      }

      function eqfeed_callback(results) {
        var heatmapData = [];
        let lines = results.split(/\r\n|\n/);
        for (var i = 0; i < lines.length; i++) {
          let line = lines[i].split(',');
          var latLng = new google.maps.LatLng(line[15], line[16]);
          heatmapData.push(latLng);
        }
        var heatmap = new google.maps.visualization.HeatmapLayer({
          data: heatmapData,
          dissipating: false,
          map: map
        });

        // var gradient = [
        //   'rgba(0, 255, 255, 0)',
        //   'rgba(0, 255, 255, 1)',
        //   'rgba(0, 191, 255, 1)',
        //   'rgba(0, 127, 255, 1)',
        //   'rgba(0, 63, 255, 1)',
        //   'rgba(0, 0, 255, 1)',
        //   'rgba(0, 0, 223, 1)',
        //   'rgba(0, 0, 191, 1)',
        //   'rgba(0, 0, 159, 1)',
        //   'rgba(0, 0, 127, 1)',
        //   'rgba(63, 0, 91, 1)',
        //   'rgba(127, 0, 63, 1)',
        //   'rgba(191, 0, 31, 1)',
        //   'rgba(255, 0, 0, 1)'
        // ]
        // heatmap.set('gradient',  gradient);
        heatmap.set('radius',  1);
      }
    </script>
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBj6Nk45Ze1yvmDH4lCFrDBDsNiY5_cHnQ&libraries=visualization&callback=initMap">
    </script>
  </body>
</html>