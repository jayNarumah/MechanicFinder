<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
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
        var map, infoWindow, markerA, markerB, drag_pos;

        function initMap() {
            map = new google.maps.Map(document.getElementById('map'), {
                center: {
                    lat: -34.397,
                    lng: 150.644
                },
                zoom: 18
            });
            markerA = new google.maps.Marker({
                map: map
            });
            markerB = new google.maps.Marker({
                map: map
            });
            infoWindow = new google.maps.InfoWindow;
            var directionsService = new google.maps.DirectionsService();
            var directionsRenderer1 = new google.maps.DirectionsRenderer({
                map: map,
                suppressMarkers: true
            });
            var directionsRenderer2 = new google.maps.DirectionsRenderer({
                map: map,
                suppressMarkers: true,
                polylineOptions: {
                    strokeColor: "gray"
                }
            });

            // Try HTML5 geolocation.
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var pos = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };

                    map.setCenter(pos);
                    map.setZoom(16);
                    //Put markers on the place
                    infoWindow.setContent('Your Location');
                    markerA.setPosition(pos);
                    markerA.setVisible(true);
                    markerA.setLabel('Me');
                    markerA.addListener('click', function() {
                        infoWindow.open(map, markerA);
                    });

                    //Get new lat long to put marker B 500m above Marker A
                    var earth = 6378.137, //radius of the earth in kilometer
                        pi = Math.PI,
                        m = (1 / ((2 * pi / 360) * earth)) / 1000; //1 meter in degree

                    var new_latitude = pos.lat + (600 * m);
                    var new_pos = {
                        lat: new_latitude,
                        lng: position.coords.longitude
                    };

                    markerB.setPosition(new_pos, );
                    markerB.setVisible(true);
                    markerB.setLabel('Stop');
                    markerB.setDraggable(true);

                    //Everytime MarkerB is drag Directions Service is use to get all the route
                    google.maps.event.addListener(markerB, 'dragend', function(evt) {
                        var drag_pos1 = {
                            lat: evt.latLng.lat(),
                            lng: evt.latLng.lng()
                        };

                        directionsService.route({
                                origin: pos,
                                destination: drag_pos1,
                                travelMode: 'DRIVING',
                                provideRouteAlternatives: true
                            },
                            function(response, status) {
                                if (status === 'OK') {

                                    for (var i = 0, len = response.routes.length; i < len; i++) {
                                        if (i === 0) {
                                            directionsRenderer1.setDirections(response);
                                            directionsRenderer1.setRouteIndex(i);

                                        } else {

                                            directionsRenderer2.setDirections(response);
                                            directionsRenderer2.setRouteIndex(i);
                                        }
                                    }
                                    console.log(response);
                                } else {
                                    window.alert('Directions request failed due to ' + status);
                                }
                            });
                    });
                }, function() {
                    handleLocationError(true, infoWindow, map.getCenter());
                });
            } else {
                // Browser doesn't support Geolocation
                handleLocationError(false, infoWindow, map.getCenter());
            }
        }

        function handleLocationError(browserHasGeolocation, infoWindow, pos) {
            infoWindow.setPosition(pos);
            infoWindow.setContent(browserHasGeolocation ?
                'Error: The Geolocation service failed.' :
                'Error: Your browser doesn\'t support geolocation.');
            infoWindow.open(map);
        }

    </script>

    <script src="https://maps.googleapis.com/maps/api/js?key={{env('GOOGLE_MAP_KEY')}}&callback=initMap">
    </script>

</body>
