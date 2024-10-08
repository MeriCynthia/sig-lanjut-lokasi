<?php
// Tampilkan flash message jika ada
display_flash_message();
?>
<a href="<?= BASEURL; ?>/transaksi/tambah" class="w-100 btn btn-icon btn-3 btn-success m-2" type="button">
  <i class="fa-solid fa-plus"></i> Tambahkan</a>
<div class="table-responsive-md">
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Produk</th>
        <th>Harga (Rp)</th>
        <th>Toko</th>
        <th class="text-center">Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($data['transaksi'] as $transaksi): ?>
        <tr>
          <td><?= $transaksi['name']; ?></td>
          <td><?= number_format($transaksi['harga'], 0, '.', ','); ?></td>
          <td><?= $transaksi['shop']; ?></td>
          <td class="align-middle text-center d-flex justify-content-evenly">
            <button class="edit btn btn-info my-0" data-bs-toggle="modal" data-bs-target="#modal-edit"
              data-id="<?= $transaksi['id']; ?>" data-prod="<?= $transaksi['name']; ?>" data-harga="<?= $transaksi['harga']; ?>"
              data-shop="<?= $transaksi['shop']; ?>">Edit</button>
            <button class="hapus btn btn-danger my-0" data-bs-toggle="modal" data-bs-target="#modal-delete"
              data-id="<?= $transaksi['id']; ?>" data-prod="<?= $transaksi['name']; ?>" data-harga="<?= $transaksi['harga']; ?>"
              data-shop="<?= $transaksi['shop']; ?>">Hapus</button>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <!-- modal -->
  <div class="modal fade" tabindex="-1" id="modal-edit" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <form id="edit-link" method="post" enctype="multipart/form-data" class="modal-content needs-validation"
        novalidate>
        <div class="modal-header">
          <h5 class="modal-title" id="modal-edit-head">Menu Edit</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="_method" value="PUT">
          <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>">
          <div class="">
          <span class="badge bg-secondary" id="prodIcon">Secondary</span>
          <span class="badge bg-info text-dark" id="shopIcon">Info</span>
          </div>
          <div class="">
            <label for="harga" class="form-label">Harga</label>
            <div class="input-group mb-3">
              <span class="input-group-text">Rp</span>
              <input type="text" onkeypress='return event.charCode >= 48 && event.charCode <= 57' class="form-control"
                id="valueHarga" name="harga" required aria-label="Harga (Bisa Ratusan dan Ribuan, bahkan Jutaan)">
            </div>
            <div class="invalid-feedback">
              Please provide a valid Price
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-danger">Update Data</button>
        </div>
      </form>
    </div>
  </div>
  <div class="modal fade" tabindex="-1" id="modal-delete" aria-labelledby="hapusModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modal-delete-head"></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="delete-link" class="modal-footer" method="post" enctype="multipart/form-data">
          <input type="hidden" name="_method" value="DELETE">
          <!-- Optional: CSRF Token -->
          <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>">
          <button type="submit" class="btn btn-danger">Hapus</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  // jQuery code here
  $("#valueHarga").on("keyup", function (event) {
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

  if (window.innerWidth <= 425) {
    const edits = document.getElementsByClassName('edit');
    for (let i = 0; i < edits.length; i++) {
      edits[i].className = "edit btn btn-info m-0 p-1";
      edits[i].innerHTML = "<i class='fa-solid fa-pencil'></i>";
    }
    const hapus = document.getElementsByClassName('hapus');
    for (let i = 0; i < hapus.length; i++) {
      hapus[i].className = "hapus btn btn-danger m-0 p-1";
      hapus[i].innerHTML = "<i class='fa-solid fa-trash'></i>";
    }
  }
  console.log(window.innerWidth);
  
  let formatter = new Intl.NumberFormat('en-US');

  document.addEventListener('DOMContentLoaded', function () {
    var modalEdit = document.getElementById('modal-edit');
    modalEdit.addEventListener('show.bs.modal', function (event) {
      var id = event.relatedTarget.getAttribute('data-id');
      var prod = event.relatedTarget.getAttribute('data-prod');
      var shop = event.relatedTarget.getAttribute('data-shop');
      var harga = event.relatedTarget.getAttribute('data-harga');
      let formattedAngka = formatter.format(harga);
      var link = `<?= BASEURL ?>/transaksi/update/${id}`;
      console.log(link);
      document.getElementById('edit-link').setAttribute('action', link);
      document.getElementById('prodIcon').innerHTML = prod;
      document.getElementById('shopIcon').innerHTML = shop;
      document.getElementById('valueHarga').value = formattedAngka;
    });

    var modalHapus = document.getElementById('modal-delete');
    modalHapus.addEventListener('show.bs.modal', function (event) {
      var id = event.relatedTarget.getAttribute('data-id');
      var prod = event.relatedTarget.getAttribute('data-prod');
      var shop = event.relatedTarget.getAttribute('data-shop');
      var harga = event.relatedTarget.getAttribute('data-harga');
      let formattedAngka = formatter.format(harga);
      var link = `<?= BASEURL ?>/transaksi/delete/${id}`;
      console.log(link);
      document.getElementById('delete-link').setAttribute('action', link);
      document.getElementById('modal-delete-head').innerText = `${prod} | ${shop} | Rp${formattedAngka}`;
    });
  });

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