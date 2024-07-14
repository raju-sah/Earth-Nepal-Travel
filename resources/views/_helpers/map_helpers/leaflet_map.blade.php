<script src='https://unpkg.com/leaflet@1.8.0/dist/leaflet.js' crossorigin=''></script>
<script src='https://unpkg.com/leaflet-control-geocoder@2.4.0/dist/Control.Geocoder.js'></script>

<script>
    let map, markers = [];
    let geocoder;

    function initMap() {
        map = L.map('map', {
            center: {
                lat: 28.626137,
                lng: 79.821603,
            },
            zoom: 5
        });

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© Onviro CMS'
        }).addTo(map);

        map.on('click', mapClicked);
        initMarkers();
    }

    initMap();

    function initMarkers() {
        const initialMarkers = <?php echo json_encode($initialMarker, JSON_THROW_ON_ERROR); ?>;

        for (let index = 0; index < initialMarkers.length; index++) {
            const data = initialMarkers[index];
            const marker = generateMarker(data, index);
            marker.addTo(map).bindPopup(
                `<b>Latitude:</b> ${data.position.lat}<br><b>Longitude:</b> ${data.position.lng}`);
            map.panTo(data.position);
            markers.push(marker)
        }
    }

    function generateMarker(data, index) {
        return L.marker(data.position, {
            draggable: data.draggable
        })
            .on('click', (event) => markerClicked(event, index))
            .on('dragend', (event) => markerDragEnd(event, index));
    }


    function clearMarkers() {
        markers.forEach(marker => {
            marker.remove();
        });
        markers = [];
    }

    function mapClicked($event) {
        const latlng = $event.latlng;
        console.log(`Clicked on Map - Latitude: ${latlng.lat}, Longitude: ${latlng.lng}`);
    }

    function markerClicked($event, index) {
        const latlng = $event.latlng;
        console.log(`Clicked on Marker ${index} - Latitude: ${latlng.lat}, Longitude: ${latlng.lng}`);
        document.getElementById('latitude').value = latlng.lat;
        document.getElementById('longitude').value = latlng.lng;
    }

    function markerDragEnd($event, index) {
        const latlng = $event.target.getLatLng();
        console.log(`Marker ${index} Dragged - New Latitude: ${latlng.lat}, New Longitude: ${latlng.lng}`);
        $event.target.getPopup().setContent(`<b>Latitude:</b> ${latlng.lat}<br><b>Longitude:</b> ${latlng.lng}`);
        document.getElementById('latitude').value = latlng.lat;
        document.getElementById('longitude').value = latlng.lng;
    }
</script>
