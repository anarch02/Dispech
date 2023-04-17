import 'leaflet/dist/leaflet';

// import 'esri-leaflet/dist/esri-leaflet';
// import 'esri-leaflet-vector/dist/esri-leaflet-vector';
// import 'esri-leaflet-geocoder/dist/esri-leaflet-geocoder';

import { vectorBasemapLayer } from "esri-leaflet-vector";
import { geosearch } from "esri-leaflet-geocoder";
import { arcgisOnlineProvider } from "esri-leaflet-geocoder";

import 'leaflet-draw/dist/leaflet.draw';
import 'jquery/dist/jquery';



// TODO Главный вариант

// var map = L.map('map').setView([41, 69], 7);

//   L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
//       maxZoom: 19,
//   }).addTo(map);


// // Initialise the FeatureGroup to store editable layers
// var drawnItems = new L.FeatureGroup();
// map.addLayer(drawnItems);

// // Initialise the draw control and pass it the FeatureGroup of editable layers
// var drawControl = new L.Control.Draw({
//   edit: {
//     featureGroup: drawnItems
//   }
// });

// map.addControl(drawControl);

// map.on(L.Draw.Event.CREATED, function (e) {
//   console.clear();
//   var type = e.layerType
//   var layer = e.layer;
  

//   // Do whatever else you need to. (save to db, add to map etc)
  
//   drawnItems.addLayer(layer);
  
//   console.log("Coordinates:");
  
//   if (type == "marker" || type == "circle" || type == "circlemarker"){
//     console.log([layer.getLatLng().lat, layer.getLatLng().lng]);
//   }
//   else {
//     var objects = layer.getLatLngs()[0];
//     for (var i = 0; i < objects.length; i++){
//       console.log([objects[i].lat,objects[i].lng]);
//     }
//   }
  
  
// });


const input = document.querySelector('#cordinates');


if(input != null)
{
  var cordinates = JSON.parse(input.getAttribute('data-params'));

  var mapCenterLat = cordinates[0].centerLat;
  var mapCenterLng = cordinates[0].centerLng;
  var zoom = cordinates[0].zoom;


  const newArr = cordinates.map(item => [item.lat, item.lng]);

  var map = L.map('map').setView([mapCenterLat, mapCenterLng], zoom);

  L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
      maxZoom: 19,
  }).addTo(map);
  

  var polygon = L.polygon(newArr).addTo(map);

}else{

  var map = L.map('map').setView([41, 69], 7);

  L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
      maxZoom: 19,
  }).addTo(map);

  
  const apiKey = "AAPKc60e21869fcb42548fb4f22b8a2bcf74Rm0Q823lp-MmVjINShJ3VB5pzZcAQrKMPUNcsfBC2ZLTDC-B1M3JL4bqM2N9EtO9";

  const basemapEnum = "ArcGIS:Navigation";

  vectorBasemapLayer(basemapEnum, {
    apiKey: apiKey
  }).addTo(map);

  const searchControl = geosearch({
    position: "topright",
    placeholder: "Enter an address or place e.g. 1 York St",
    useMapBounds: false,

    providers: [
      arcgisOnlineProvider({
        apikey: apiKey,
        nearby: {
          lat: -33.8688,
          lng: 151.2093
        }
      })
    ]

  }).addTo(map);

  const results = L.layerGroup().addTo(map);

  searchControl.on("results", (data) => {
    results.clearLayers();

    for (let i = data.results.length - 1; i >= 0; i--) {
      const marker = L.marker(data.results[i].latlng);

      const lngLatString = `${Math.round(data.results[i].latlng.lng * 100000) / 100000}, ${
        Math.round(data.results[i].latlng.lat * 100000) / 100000
      }`;
      marker.bindPopup(`<b>${lngLatString}</b><p>${data.results[i].properties.LongLabel}</p>`);


      results.addLayer(marker);

      marker.openPopup();

    }

  });

  var drawnItems = new L.FeatureGroup();
  map.addLayer(drawnItems);

  // Initialise the draw control and pass it the FeatureGroup of editable layers
  var drawControl = new L.Control.Draw({
    position: 'bottomleft',
    draw: {
      polyline: false,
      circlemarker: false,
      rectangle: false,
      marker: false,
    },
    edit: {
      featureGroup: drawnItems
    }
  });

  map.addControl(drawControl);

  map.on(L.Draw.Event.CREATED, function (e) {
    console.clear();
    var type = e.layerType
    var layer = e.layer;
    
    var type = e.layerType,
      layer = e.layer;

      console.log(e);

      if (type == 'polygon') 
      {
        var cordinates = e.layer._latlngs;
        var centerLat = e.target._lastCenter.lat;
        var centerLng = e.target._lastCenter.lng;
        var zoom = e.target.boxZoom._map._zoom;
        // var lastCenter = e.target.zoomConrol._map._lastCenter;
        // console.log(cordinates);
        // console.log(lastCenter);
        // console.log(zoom);
        $('#centerLat').val(centerLat);
        $('#centerLng').val(centerLng);
        $('#zoom').val(zoom);

        const lat = cordinates.map(coord => coord.lat);
        const lng = cordinates.map(coord => coord.lng);

        const form = document.querySelector('form');

        for (let i = 0; i< lat.length; i++) {
            const inputLat = createInput('lat[]', lat[i]);
            form.appendChild(inputLat);
            const inputLng = createInput('lng[]', lng[i]);
            form.appendChild(inputLng);
        }

        function createInput(name, value) {
            const input = document.createElement("input");
            input.setAttribute('type', 'hidden');
            input.setAttribute('name', name);
            input.value = value;
            return input;
        }


        $('#lats').val(lats);
      }

        console.log([layer.getLatLng().lat, layer.getLatLng().lng]);
        console.log(layer._mRadius);

        var cordinates = e.layer._latlngs;
        var centerLat = e.target._lastCenter.lat;
        var centerLng = e.target._lastCenter.lng;
        var zoom = e.target.boxZoom._map._zoom;

        var radius = layer._mRadius;
        radius = Math.ceil(radius);

        $('#radius').val(radius);

        $('#centerLat').val(centerLat);
        $('#centerLng').val(centerLng);
        $('#zoom').val(zoom);

        const inputLat = createInput('lat[]', layer.getLatLng().lat);
        form.appendChild(inputLat);
        const inputLng = createInput('lng[]', layer.getLatLng().lng);
        form.appendChild(inputLng);

        function createInput(name, value) {
            const input = document.createElement("input");
            input.setAttribute('type', 'hidden');
            input.setAttribute('name', name);
            input.value = value;
            return input;
        }
      
      

      
      // $('#lngs').val(lngs);

    // Do whatever else you need to. (save to db, add to map etc)
    
    drawnItems.addLayer(layer);
    
    console.log("Coordinates:");
    
    if (type == "marker" || type == "circle" || type == "circlemarker"){
      console.log([layer.getLatLng().lat, layer.getLatLng().lng]);
    }
    else {
      var objects = layer.getLatLngs()[0];
      for (var i = 0; i < objects.length; i++){
        console.log([objects[i].lat,objects[i].lng]);
      }
    }
    
    
  });


//   var editableLayers = new L.FeatureGroup();
//   map.addLayer(editableLayers);

//   var options = {
//     position: 'topleft',
//     draw: {
//       polygon: {
//         allowIntersection: false, // Restricts shapes to simple polygons
//         drawError: {
//           color: '#e1e100', // Color the shape will turn when intersects
//           message: '<strong>Oh snap!<strong> you can\'t draw that!' // Message that will show when intersect
//         },
//         shapeOptions: {
//           color: '#97009c'
//         }
//       },
//       polyline: {
//         shapeOptions: {
//           color: '#f357a1',
//           weight: 10
//             }
//       },
//       // disable toolbar item by setting it to false
//       polyline: false,
//       circle: false, // Turns off this drawing tool
//       polygon: true,
//       marker: false,
//       rectangle: false,
//     },
//     edit: {
//       featureGroup: editableLayers, //REQUIRED!!
//     }
//   };

// // Initialise the draw control and pass it the FeatureGroup of editable layers
//   var drawControl = new L.Control.Draw(options);
//   map.addControl(drawControl);

//   var editableLayers = new L.FeatureGroup();
//   map.addLayer(editableLayers);

//   map.on('draw:created', function(e) {

//       var type = e.layerType,
//       layer = e.layer;

//       console.log(e);


//       var cordinates = e.layer._latlngs[0];
//       var centerLat = e.target._lastCenter.lat;
//       var centerLng = e.target._lastCenter.lng;
//       var zoom = e.target.boxZoom._map._zoom;
//       // var lastCenter = e.target.zoomConrol._map._lastCenter;
//       // console.log(cordinates);
//       // console.log(lastCenter);
//       // console.log(zoom);
//       $('#centerLat').val(centerLat);
//       $('#centerLng').val(centerLng);
//       $('#zoom').val(zoom);
      

//       const lat = cordinates.map(coord => coord.lat);
//       const lng = cordinates.map(coord => coord.lng);

//       const form = document.querySelector('form');

//       for (let i = 0; i< lat.length; i++) {
//           const inputLat = createInput('lat[]', lat[i]);
//           form.appendChild(inputLat);
//           const inputLng = createInput('lng[]', lng[i]);
//           form.appendChild(inputLng);
//       }

//       function createInput(name, value) {
//           const input = document.createElement("input");
//           input.setAttribute('type', 'hidden');
//           input.setAttribute('name', name);
//           input.value = value;
//           return input;
//       }


//       $('#lats').val(lats);
//       // $('#lngs').val(lngs);

//     if (type === 'polyline') {
//       layer.bindPopup('A polyline!');
//     } else if ( type === 'polygon') {
//       layer.bindPopup('A polygon!');
//     } else if (type === 'marker') 
//     {layer.bindPopup('marker!');}
//     else if (type === 'circle') 
//     {layer.bindPopup('A circle!');}
//     else if (type === 'rectangle') 
//     {layer.bindPopup('A rectangle!');}


//     editableLayers.addLayer(layer);
//   });
}

// L.control.bigImage({position: 'topright'}).addTo(map);