window._ = require('lodash');
window.axios = require('axios');

var map;

initMap = function() {
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
        zoom: 5
            // mapTypeId: google.maps.MapTypeId.ROADMAP
    });

    axios.get('/api/solutions/'+id)
      .then(function (response) {
        // console.log(response);
        var data = response.data.data;
        // console.log(data);
        showSelectedFacilities(data);
        showDemandPoints(data);
        showAssignments(data);        
      })
      .catch(function (error) {
        // console.log(error);
      });
}

function showAssignments(data) {
    // console.log(data);
    let demandPoints = data.demandPoints;
    let openFacilities = data.openFacilities;
    let assignments = data.assignments;
    _.forEach(assignments, (assignment) => {
        let facility = _.find(openFacilities, (o) => o[0] == assignment[0]);
        let demandPoint = _.find(demandPoints, (o) => o[0] == assignment[1]);

        let line = [{ lat: facility[1], lng: facility[2] }, { lat: demandPoint[1], lng: demandPoint[2] }];
        // console.log(line);
        new google.maps.Polyline({
            map: map,
            path: line,
            geodesic: true,
            strokeColor: '#44423D',
            strokeOpacity: 1.0,
            strokeWeight: 1.2
        });

    })
}


function showDemandPoints(data) {
    var circle = {
        path: 'M 100, 100 m -75, 0 a 75,75 0 1,0 150,0 a 75,75 0 1,0 -150,0',
        fillColor: '#30AC68',
        fillOpacity: 0.6,
        scale: 0.075,
        strokeColor: '#30AC68',
        strokeWeight: 0.5,
        strokeOpacity: 0.9,
        anchor: new google.maps.Point(100, 100)
    };

    var createMarker = function(id, demand, coordinate) {
        circle.scale =
            0.075 * (1 + 2.5 * (demand - mindemand) / (maxdemand - mindemand));
        new google.maps.Marker({
            map: map,
            position: coordinate,
            icon: circle,
            zIndex: 5,
            optimized: false
        });
    };

    maxdemand = _.maxBy(data.demandPoints, (demandPoint) => {
        return demandPoint[3];
    })[3];
    // console.log(maxdemand);
    mindemand = _.minBy(data.demandPoints, (demandPoint) => {
        return demandPoint[3];
    })[3];
    // console.log(mindemand);

    _.forEach(data.demandPoints, (demandPoint) => {
        // console.log(demandPoint);
        var coordinate = new google.maps.LatLng(demandPoint[1], demandPoint[2]);
        createMarker(demandPoint[0], demandPoint[3], coordinate);
    });

}

function showSelectedFacilities(data) {
    var goldStar = {
        path: 'M 125,5 155,90 245,90 175,145 200,230 125,180 50,230 75,145 5,90 95,90 z',
        fillColor: 'yellow',
        fillOpacity: 1,
        scale: 0.2,
        strokeColor: 'gold',
        strokeWeight: 2,
        anchor: new google.maps.Point(125, 125)
    };

    // var facility = 'img/facility1.png';

    var facilityImg = {
        url: '/img/facility1.png',
        // This marker is 20 pixels wide by 32 pixels high.
        size: new google.maps.Size(156, 138),
        // The origin for this image is (0, 0).
        origin: new google.maps.Point(0, 0),
        // The anchor for this image is the base of the flagpole at (0, 32).
        anchor: new google.maps.Point(15, 15),
        scaledSize: new google.maps.Size(30, 30)
    };

    var createMarker = function(id, coordinate) {
        new google.maps.Marker({
            map: map,
            position: coordinate,
            icon: facilityImg,
            zIndex: 20,
            optimized: false
        });
    };

    _.forEach(data.openFacilities, (facility) => {
        // console.log(facility);
        var coordinate = new google.maps.LatLng(facility[1], facility[2]);
        createMarker(facility[0], coordinate);
    });
}
