// Init Variables //
var maps;
var markers = new Array();
var categorys = new Array();
//end//

//Document Ready//
$(document).ready(function(){
  markers = getMarkers();
  categorys = getCategorys();

  //Bind Radio
  $('input[type="radio"]').on('click', function(){
    var id = $(this).attr('id');
    if($(this).is(':checked')){
      showToMap(id);
    }
    else {
      clearMarkers();
    }
  });

  //Jquery Tooltip
  $('[data-toggle="tooltip"]').tooltip();

  //Empty SearchBar onClick
  $('#search-query').on('click', function(){
    $(this).val("");
  });
})
//end//

//Init Map//
function initMap() {
//   map = new google.maps.Map(document.getElementById('map'), {
//     center: {lat: -6.206518, lng: 106.849418},
//     zoom: 12,
 map = new google.maps.Map(document.getElementById('map'), {
    center: {lat: -0.9219036, lng: 117.7256732},
    zoom: 5.5,
    mapTypeId: google.maps.MapTypeId.ROADMAP,
    disableDefaultUI: true,
    styles:
    [
        {
            "featureType": "all",
            "elementType": "labels.text.fill",
            "stylers": [
                {
                    "color": "#ffffff"
                }
            ]
        },
        {
            "featureType": "all",
            "elementType": "labels.text.stroke",
            "stylers": [
                {
                    "color": "#000000"
                },
                {
                    "lightness": 13
                }
            ]
        },
        {
            "featureType": "administrative",
            "elementType": "geometry.fill",
            "stylers": [
                {
                    "color": "#000000"
                }
            ]
        },
        {
            "featureType": "administrative",
            "elementType": "geometry.stroke",
            "stylers": [
                {
                    "color": "#144b53"
                },
                {
                    "lightness": 14
                },
                {
                    "weight": 1.4
                }
            ]
        },
        {
            "featureType": "landscape",
            "elementType": "all",
            "stylers": [
                {
                    "color": "#08304b"
                }
            ]
        },
        {
            "featureType": "poi",
            "elementType": "geometry",
            "stylers": [
                {
                    "color": "#0c4152"
                },
                {
                    "lightness": 5
                }
            ]
        },
        {
            "featureType": "road.highway",
            "elementType": "geometry.fill",
            "stylers": [
                {
                    "color": "#000000"
                }
            ]
        },
        {
            "featureType": "road.highway",
            "elementType": "geometry.stroke",
            "stylers": [
                {
                    "color": "#0b434f"
                },
                {
                    "lightness": 25
                }
            ]
        },
        {
            "featureType": "road.arterial",
            "elementType": "geometry.fill",
            "stylers": [
                {
                    "color": "#000000"
                }
            ]
        },
        {
            "featureType": "road.arterial",
            "elementType": "geometry.stroke",
            "stylers": [
                {
                    "color": "#0b3d51"
                },
                {
                    "lightness": 16
                }
            ]
        },
        {
            "featureType": "road.local",
            "elementType": "geometry",
            "stylers": [
                {
                    "color": "#000000"
                }
            ]
        },
        {
            "featureType": "transit",
            "elementType": "all",
            "stylers": [
                {
                    "color": "#146474"
                }
            ]
        },
        {
            "featureType": "water",
            "elementType": "all",
            "stylers": [
                {
                    "color": "#021019"
                }
            ]
        }
    ]
  });

  //Traffic Layer
  trafficLayer = new google.maps.TrafficLayer();

  //Search Box
  var input = document.getElementById('search-query');
  var searchBox = new google.maps.places.SearchBox(input);

  map.addListener('bounds_changed', function() {
    searchBox.setBounds(map.getBounds());
  });

  //Bind SearchBox
  searchBox.addListener('places_changed', function() {
    var places = searchBox.getPlaces();
    if (places.length == 0) {
      return;
    }

    var bounds = new google.maps.LatLngBounds();
    places.forEach(function(place) {
      if (!place.geometry) {
        console.log("Returned place contains no geometry");
        return;
      }

      if (place.geometry.viewport) {
        bounds.union(place.geometry.viewport);
      } else {
        bounds.extend(place.geometry.location);
      }
    });

    map.fitBounds(bounds);
  });
}
//end//
