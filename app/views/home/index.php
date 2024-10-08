<style>
    #map {
        height: 400px;
        width: 100%;
    }
</style>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-body px-0 pt-0 pb-2">
                    <div id="reader" width="600px"></div>
                    <!-- <input type="file" id="qr-input-file" accept="image/*"> -->
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card z-index-3">
                <div class="card-body p-2">
                    <form action="#" id="searchForm">
                        <!-- Kontrol untuk mengubah radius -->
                        <div class="form-group d-flex">
                            <label class="h3 text-nowrap">Product ID: </label><input type="number"
                                class="form-control p-0 ps-1 ms-2" id="cameraValue" value="1234567890123" />
                        </div>
                        <label for="radiusInput">
                            <h4 class="text-capitalize m-0">Radius</h4>
                        </label>
                        <input class="w-100 m-0" type="range" id="radiusInput" min="10" max="10000" step="10"
                            value="5000">
                        <span id="radiusValue">3500</span> Meter
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col">
            <div class="card z-index-3" id="map">
            </div>
        </div>
    </div>
</div>

<script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
<script>
    let productID = document.getElementById('cameraValue');
    let html5QrcodeScanner = new Html5QrcodeScanner(
        "reader",
        { fps: 10, qrbox: { width: 250, height: 250 } },
            /* verbose= */ false);
    html5QrcodeScanner.render((decodedText, decodedResult) => {
        productID.value = decodedText;
        p.value = decodedText;
    }, (error) => {
        console.warn(`Code scan error = ${error}`);
    });
    // -0.05187711699572585, 109.35046474605898 gor untan
    let map,
        userLocation,
        circle,
        advancedMarkers = [], // list yang menyimpan AdvanceMarker Object
        AdvanceMarker; // template class google.AdvanceMarker

    // -0.05641370274947123, 109.34843154922905
    let radiusInput = document.getElementById('radiusInput');
    let radiusValue = document.getElementById('radiusValue');

    if (navigator.geolocation) {
        console.log("mengambil data lokasi...");
        navigator.geolocation.getCurrentPosition((position) => {
            userLocation = {
                lat: position.coords.latitude,
                lng: position.coords.longitude,
            };
            console.log("Lokasi Ditemukan!\nLat: ", position.coords.latitude, "\nLng: ", position.coords.longitude);
        },
            (error) => {
                // Penanganan error
                switch (error.code) {
                    case error.PERMISSION_DENIED:
                        alert("Pengguna menolak permintaan Geolocation.");
                        break;
                    case error.POSITION_UNAVAILABLE:
                        alert("Informasi lokasi tidak tersedia.");
                        break;
                    case error.TIMEOUT:
                        alert("Permintaan mengambil lokasi mengalami timeout.");
                        break;
                    case error.UNKNOWN_ERROR:
                        alert("Terjadi kesalahan yang tidak diketahui.");
                        break;
                }
            },
            {
                enableHighAccuracy: true,  // Menggunakan GPS atau metode yang lebih akurat
                timeout: 10000,  // Timeout jika tidak bisa mengambil lokasi dalam 10 detik
                maximumAge: 0  // Tidak menggunakan cache, selalu mengambil lokasi terbaru
            }
        )
    } else {
        alert("Geolocation is not supported by this browser.\nstart using defailt value");
    }

    // Fungsi untuk menghapus semua marker
    function clearMarkers() {
        for (let i = 0; i < markers.length; i++) {
            markers[i].setMap(null); // Menghapus marker dari peta
        }
        markers = []; // Kosongkan array markers
    }

    async function initMap() {
        // Request needed libraries.
        const { Map } = await google.maps.importLibrary("maps");
        const { AdvancedMarkerElement } = await google.maps.importLibrary("marker");
        AdvanceMarker = AdvancedMarkerElement;

        //draw map
        map = new Map(document.getElementById('map'), {
            center: userLocation,
            zoom: 13,
            mapId: 'storied-deck-432408-h3'
        });

        // marker mySelf
        new AdvancedMarkerElement({
            map,
            position: userLocation,
            title: "Lokasi Anda",
        });

        circle = new google.maps.Circle({
            map: map,
            radius: parseInt(radiusInput.value), // Radius dari input range
            center: userLocation,
            fillColor: '#AA0000',
            fillOpacity: 0.2,
            strokeColor: '#AA0000',
            strokeOpacity: 0.5,
            strokeWeight: 2
        });

        // Event listener untuk mengubah radius ketika input berubah
        radiusInput.addEventListener('input', function () {
            const newRadius = parseInt(radiusInput.value);
            radiusValue.textContent = newRadius;
            circle.setRadius(newRadius);
            // fetchDataAndDisplayPOI(); // Refresh PoI sesuai radius baru
        });

        // pilih posisi intu input
        google.maps.event.addListener(advancedMarkers, 'position_changed', function () {
            const lat = marker.getPosition().lat();
            const lng = marker.getPosition().lng();
            circle.setCenter({ lat, lng });
            // fetchDataAndDisplayPOI(); //data marker in radius berubah secara realtime
            console.log(circle.getCenter().lat(), circle.getCenter().lng());
        });

        map.addListener('click', (event) => {
            marker.setPosition(event.latLng);
        });
    }

    // Form submission handler
    document.getElementById("searchForm")
        .addEventListener("submit", async function (event) {
            event.preventDefault();
            // kosongkan list tiap marker
            clearMarkers();

            console.log("go submit...", `<?= BASEURL ?>/api/search-code.php?id=${productID.value}`);

            fetch(`<?= BASEURL ?>/api/search-code.php?id=${productID.value}`)
                .then(response => {
                    if (!response.ok) {
                        console.warn('Network response was not ok: ', response);
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.error) {
                        if (confirm(`Code ${productID.value} tidak ditemukan di database 😔.\nIngin Menambahkan Data Produk ini 😙?`)) {
                            window.location.href = `<?= BASEURL ?>/produk/create/${productID.value}`;
                        }
                        return false;
                    }
                    console.log("Masuk ke Fetching...");
                    const shops = data.filter(shop => {
                        const distance = calculateDistance({ lat: circle.getCenter().lat(), lng: circle.getCenter().lng() }, { lat: shop.lat, lng: shop.lng });

                        //tambahkan data distance
                        shop.distance = distance;
                        return distance <= circle.getRadius(); // Filter berdasarkan radius lingkaran saat ini
                    });

                    // if data tidak dalam range, maka fokuskan ke lokasi range dan buat alert data tidak dalam range
                    if (shops.length == 0) {
                        alert("data tidak dalam range 🥲!");
                        return false;
                    }

                    // // Sort by harga (cheapest first)
                    shops.sort((a, b) => a.harga - b.harga);
                    console.log("sort by harga: ", shops);

                    showShops(shops, parseInt(radiusInput.value));
                    // findCheapestShop(shops);
                })
                .catch(error => {
                    console.error('Error:', error);
                });;
        })

    // Clear previous markers
    function clearMarkers() {
        advancedMarkers.forEach((marker) => (
            marker.map = null
        ));
        advancedMarkers = [];
    }

    // Show shops within range using AdvancedMarkerElement
    function showShops(shops, range) {

        let bounds = new google.maps.LatLngBounds();
        console.log("range: ", range, typeof (range));
        console.log("userLocation", userLocation);
        let marker;
        shops.forEach((shop) => {
            if (shop.distance <= range) {
                const shopLocation = new google.maps.LatLng(shop.lat, shop.lng);

                // ubah angka jadi ribuan
                let formatedHarga = new Intl.NumberFormat('en-US').format(shop.harga);


                // Create custom HTML for AdvancedMarkerElement
                const content = document.createElement("div");
                content.className = "card shadow-sm";
                content.innerHTML = `
                        <div class="card-header bg-primary text-white text-center">
                            <h5 class="mb-0">Rp${formatedHarga}</h5>
                        </div>
                        <div class="card-body">
                            <h6 class="card-title">${shop.name}</h6>
                        </div>
                    `;

                // Create AdvancedMarkerElement
                marker = new AdvanceMarker({
                    position: shopLocation,
                    map: map,
                    content: content,
                });
                advancedMarkers.push(marker);
                bounds.extend(userLocation);
                console.log("distance: ", shop.distance, typeof (shop.distance), "\nshopLocation:", shopLocation);
                bounds.extend(shopLocation);
            }
        });
        console.log("marker: ", marker);
        map.fitBounds(bounds);
    }

    //find cheapest
    function findCheapestShop(shops) {
        console.log("before cheap", shops);
        let cheapestShop = shops.reduce((prev, curr) =>
            prev.harga < curr.harga ? prev : curr
        );
        console.log("after cheap", cheapestShop);

        // fokus ke objek
        let bounds = new google.maps.LatLngBounds();
        let shopLoc = new google.maps.LatLng(cheapestShop.lat, cheapestShop.lng);
        console.log(shopLoc, typeof (shopLoc));

        bounds.extend(shopLoc);
        map.fitBounds(bounds);
    }

    // Fungsi untuk menghitung jarak antara dua titik menggunakan Haversine Formula
    function calculateDistance(pointA, pointB) {
        const R = 6371e3;  // Radius bumi dalam meter
        const φ1 = pointA.lat * Math.PI / 180;
        const φ2 = pointB.lat * Math.PI / 180;
        const Δφ = (pointB.lat - pointA.lat) * Math.PI / 180;
        const Δλ = (pointB.lng - pointA.lng) * Math.PI / 180;

        const a = Math.sin(Δφ / 2) * Math.sin(Δφ / 2) +
            Math.cos(φ1) * Math.cos(φ2) *
            Math.sin(Δλ / 2) * Math.sin(Δλ / 2);
        const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));

        const distance = R * c; // Dalam meter
        return distance;
    }
</script>
<script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAgGBjlEnlrlO2KdsQMFL70E_Ppo3GmFPs&loading=async&callback=initMap&libraries=marker"
    async type="text/javascript" defer></script>
</body>

</html>