<script>
    document.getElementById('search').addEventListener('keydown', function (e) {
        if (e.key === 'Enter') {
            geocodeAddress();
        }
    });

    let marker = []; // Initialize marker array outside the function

    function geocodeAddress() {

        const location = document.getElementById('search').value;

        if (location) {
            fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${location}`)
                .then(response => response.json())
                .then(data => {
                    if (data.length > 0) {
                        const latlng = {
                            lat: parseFloat(data[0].lat),
                            lng: parseFloat(data[0].lon),
                        };

                        // Clear existing marker
                        marker.forEach(marker => map.removeLayer(marker));

                        // Place multiple named marker at the searched location


                        const newMarker = generateMarker({
                            position: latlng,
                            draggable: true,

                        }, 0);

                        newMarker.addTo(map).bindPopup(`<br><b>Latitude:</b> ${latlng.lat}<br><b>Longitude:</b> ${latlng.lng}`);
                        marker.push(newMarker);


                        // You can set the map view to the first marker's location
                        map.setView(latlng, 10);
                        document.getElementById('latitude').value = latlng.lat;
                        document.getElementById('longitude').value = latlng.lng;

                    } else {
                        alert('Location not found.');
                    }
                })
                .catch(error => {
                    console.error('Error fetching geocoding data:', error);
                    alert('Error fetching geocoding data. Please try again.');
                });
        }
    }

</script>
