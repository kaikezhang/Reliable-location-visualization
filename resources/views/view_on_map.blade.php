<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
        <meta charset="UTF-8">
        <title>View solution</title>
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
    </body>
    <script>
      var id = {{$id}};
    </script>
    <script type="text/javascript" src="{{asset('js/app.js')}}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBj6Nk45Ze1yvmDH4lCFrDBDsNiY5_cHnQ&callback=initMap"></script>    
</html>