<?php
// Tampilkan flash message jika ada
display_flash_message();
?>
<div class="containe-fluid">
  <a href="<?= BASEURL ?>/transaksi" class="w-100 btn btn-secondary btn-sm mb-2">&larr; Back</a>
  <div class="row d-flex justify-content-center">
    <form action="<?= BASEURL ?>/transaksi/post" method="post" enctype="multipart/form-data"
      class="col-md-6 card needs-validation" novalidate>
      <!-- Input CSRF -->
      <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>">
      <div class="">
        <label for="produk">Produk</label>
        <select class="form-select" name="prod_id" id="produk">
          <?php foreach ($data['produk'] as $produk): ?>
            <option value="<?= $produk['id']; ?>"><?= $produk['id']; ?> | <?= $produk['name']; ?></option>
          <?php endforeach; ?>
        </select>
        <div class="valid-feedback">
          Nice Product 🛍️
        </div>
      </div>
      <div class="mb-3">
        <label for="toko" class="form-label">Toko</label>
        <select class="form-select" name="toko_id" id="toko">
          <?php foreach ($data['toko'] as $toko): ?>
            <option value="<?= $toko['id']; ?>"><?= $toko['id']; ?> | <?= $toko['name']; ?></option>
          <?php endforeach; ?>
        </select>
        <div class="valid-feedback">
          Nice Shop 🏪
        </div>
      </div>
      <div class="mb-3">
        <label for="harga" class="form-label">Harga</label>
        <div class="input-group mb-3">
          <span class="input-group-text">Rp</span>
          <input type="text" onkeypress='return event.charCode >= 48 && event.charCode <= 57' class="form-control"
            id="harga" name="harga" required aria-label="Harga (Bisa Ratusan dan Ribuan, bahkan Jutaan)" value="<?= $_SESSION['harga'] ?? '' ?>">
        </div>

        <div class="invalid-feedback">
          Please provide a valid Price
        </div>
      </div>
      <div class="mb-4 d-flex justify-content-center">
        <button class="btn btn-primary" type="submit">Submit Form</button>
      </div>
    </form>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  // jQuery code here
  $("#harga").on("keyup", function (event) {
    // When user selects text in the document, abort.
    var selection = window.getSelection().toString();
    if (selection !== '') {
      return;
    }
    // When the arrow keys are pressed, abort.
    if ($.inArray(event.keyCode, [38, 40, 37, 39]) !== -1) {
      return;
    }
    var $this = $(this);
    // Get the value.
    var input = $this.val();
    input = input.replace(/[\D\s\._\-]+/g, "");
    input = input ? parseInt(input, 10) : 0;
    $this.val(function () {
      return (input === 0) ? "" : input.toLocaleString("en-US");
    });
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