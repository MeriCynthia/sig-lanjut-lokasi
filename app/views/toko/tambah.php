<?php
// Tampilkan flash message jika ada
display_flash_message();
?>
<style>
  #map {
    height: 60vmin;
    width: 100%;
  }
</style>
<a href="<?= BASEURL ?>/toko" class="col-12 btn btn-secondary btn-sm mb-2">&larr; Kembali</a>
<div class="row">
  <div class="col-lg-8 mb-2">
    <div class="card z-index-3" id="map"></div>
  </div>
  <div class="col-lg-4">
    <div class="card">
      <div class="card-body pt-0">
        <form action="<?= BASEURL ?>/toko/post" method="post" enctype="multipart/form-data" class="needs-validation"
          novalidate>
          <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>">
          <p>*Tandai lokasi di map</p>
          <div class="form-group row gap-2 d-flex justify-cotent-around mb-3">
            <input type="double" id="lat" name="lat" class="form-control form-control-sm w-25 w-md-50 mx-3" readonly>
            <input type="double" id="lng" name="lng" class="form-control form-control-sm w-25 w-md-50" readonly>
            <div class="invalid-feedback">
              Please provide a valid Coordinate 🙏
            </div>
          </div>
          <div class="form-group my-2">
            <label for="name">Nama Toko</label>
            <input type="text" id="name" class="form-control" name="name" maxlength="30" required>
            <div class="invalid-feedback">
              Please provide a valid Name 🙏
            </div>
          </div>
          <div class="form-group mb-2">
            <label for="alamat">Alamat</label>
            <input type="text" id="alamat" class="form-control" name="alamat" maxlength="50" required>
            <div class="invalid-feedback">
              Please provide a valid Address 🙏
            </div>
          </div>
          <button type="submit" id="submit" class="btn btn-primary mb-0 d-none">Tambah Data</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  let center = { lat: -0.05187711699572585, lng: 109.35046474605898 }; // gor untan
  let map;
  let marker;
  let submit = document.getElementById('submit');

  async function initMap() {
    // Fetch data dari API
    const response = await fetch('<?= BASEURL ?>/toko/apiAllToko');
    const data = await response.json();
    console.log(+data[0].lat, typeof +data[0].lat);


    // Request needed libraries.
    const { Map } = await google.maps.importLibrary("maps");
    const { AdvancedMarkerElement } = await google.maps.importLibrary("marker");

    // Inisialisasi peta
    map = new Map(document.getElementById('map'), {
      center,
      zoom: 13,
      mapId: 'storied-deck-432408-h3'
    });


    // Membuat elemen marker custom
    const markerElement = document.createElement('h1');
    markerElement.innerHTML = '📍';  // Ikon marker custom
    markerElement.style.cursor = 'pointer';  // Ubah kursor menjadi pointer

    // Membuat marker baru dengan AdvancedMarkerElement
    const marker = new AdvancedMarkerElement({
      map,
      title: "Posisi yang ingin ditambah!",
      content: markerElement,
    });

    // Loop melalui data dari API dan tambahkan marker ke peta
    data.forEach((toko) => {
      const markerAll = new AdvancedMarkerElement({
        map,
        position: { lat: +toko.lat, lng: +toko.lng },
        title: `Nama Toko [${toko.name}] \nAlamat [${toko.alamat}]`,
      });
      console.log(markerAll);

      // Mengedit ketika di klik
      markerAll.addListener('click', function () {
        infoWindowAll.open(map, markerAll);
      });
    });

    // Membuat InfoWindow untuk menampilkan latitude dan longitude
    const infoWindow = new google.maps.InfoWindow();

    // Tambahkan event listener pada map untuk klik
    map.addListener('click', (event) => {
      // Set posisi marker sesuai dengan lokasi klik
      marker.position = event.latLng;
      marker.map = map;  // Pastikan marker tetap di peta setelah mengatur posisinya

      const latLng = event.latLng;

      // Mengisi input form dengan latitude dan longitude
      document.getElementById('lat').value = latLng.lat();
      document.getElementById('lng').value = latLng.lng();
      // input dimasukkan, tombol submit di tampilkan
      submit.classList.remove('d-none');

      // Isi InfoWindow dengan latitude dan longitude
      const contentString = `
      <div>
        <p><strong>Latitude:</strong> ${latLng.lat()}</p>
        <p><strong>Longitude:</strong> ${latLng.lng()}</p>
      </div>`;

      // Tampilkan InfoWindow di atas marker
      infoWindow.setContent(contentString);
      infoWindow.setPosition(latLng);  // Tentukan posisi InfoWindow
      infoWindow.open(map);
    });
  }

  // Example starter JavaScript for disabling form submissions if there are invalid fields
  (function () {
    'use strict'

    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.querySelectorAll('.needs-validation')

    // Loop over them and prevent submission
    Array.prototype.slice.call(forms)
      .forEach(function (form) {
        form.addEventListener('submit', function (event) {
          if (!form.checkValidity()) {
            event.preventDefault()
            event.stopPropagation()
          }

          form.classList.add('was-validated')
        }, false)
      })
  })()
</script>
<script
  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAgGBjlEnlrlO2KdsQMFL70E_Ppo3GmFPs&loading=async&callback=initMap&libraries=marker"
  async type="text/javascript" defer></script>
</script>