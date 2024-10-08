<?php
// Tampilkan flash message jika ada
display_flash_message();
?>
<div class="containe-fluid">
  <a href="<?= BASEURL ?>/produk" class="w-100 btn btn-secondary btn-sm mb-2">&larr; Kembali</a>
  <div class="row">
    <div class="col-md-6">
      <div class="card mb-4">
        <div class="card-body px-0 pt-0 pb-2">
          <div id="reader" width="600px"></div>
        </div>
      </div>
    </div>
    <form action="<?= BASEURL ?>/produk/post" method="post" enctype="multipart/form-data"
      class="col-md-6 card needs-validation" novalidate>
      <!-- Input CSRF -->
      <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>">
      <div class="">
        <label for="code" class="form-label">Code</label>
        <input type="text" class="form-control" id="code" name="id" value="<?= $data['id'] ?? '' ?>" required>
        <div class="valid-feedback">
          Nice Code 👍
        </div>
      </div>
      <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" id="name" name="name" required>
        <div class="invalid-feedback">
          Please provide a valid Name.
        </div>
      </div>
      <div class="mb-4 d-flex justify-content-center">
        <button class="btn btn-primary" type="submit">Submit form</button>
      </div>
    </form>
  </div>
</div>

<script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
<script>
  let productID = document.getElementById('code');
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