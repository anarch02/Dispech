<html>
  <head>
    <meta charset="utf-8" />
    <title>Search for feature layer data (feature service)</title>
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js" crossorigin=""></script>
    <!-- Load Esri Leaflet from CDN -->
    <script src="https://unpkg.com/esri-leaflet@3.0.10/dist/esri-leaflet.js"></script>
    <!-- Load Esri Leaflet Geocoder from CDN -->
    <link rel="stylesheet" href="https://unpkg.com/esri-leaflet-geocoder@3.1.3/dist/esri-leaflet-geocoder.css" crossorigin="" />
    <script src="https://unpkg.com/esri-leaflet-geocoder@3.1.3/dist/esri-leaflet-geocoder.js" crossorigin=""></script>
    <style>
      html,
      body,
      #map {
        padding: 0;
        margin: 0;
        height: 100%;
        width: 100%;
        font-family: Arial, Helvetica, sans-serif;
        font-size: 14px;
        color: #323232;
      }
    </style>
  </head>
  <body>
    <div id="map"></div>
    <script>
      const apiKey = "AAPKc60e21869fcb42548fb4f22b8a2bcf74Rm0Q823lp-MmVjINShJ3VB5pzZcAQrKMPUNcsfBC2ZLTDC-B1M3JL4bqM2N9EtO9";

      const map = L.map("map").setView([40.91, -96.63], 4);

      L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
        attribution: '&copy; <a href="https://osm.org/copyright">OpenStreetMap</a> contributors'
      }).addTo(map);

      const arcgisOnlineProvider = L.esri.Geocoding.arcgisOnlineProvider({
        apikey: apiKey
      });

      const gisDayProvider = L.esri.Geocoding.featureLayerProvider({
        url:
          "https://services.arcgis.com/BG6nSlhZSAWtExvp/ArcGIS/rest/services/GIS_Day_Registration_Form_2019_Hosted_View_Layer/FeatureServer/0",
        searchFields: ["event_name", "host_organization"],
        label: "GIS Day Events 2019",
        bufferRadius: 5000,
        formatSuggestion: function (feature) {
          return feature.properties.event_name + " - " + feature.properties.host_organization;
        }
      });

      L.esri.Geocoding.geosearch({
        providers: [arcgisOnlineProvider, gisDayProvider]
      }).addTo(map);
    </script>
  </body>
</html>