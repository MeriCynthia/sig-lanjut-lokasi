<a href="<?= BASEURL; ?>/transaksi/tambah" class="w-100 btn btn-icon btn-3 btn-pink m-2" type="button">
    <i class="fa-solid fa-plus"></i> Tambahkan
</a>

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
                            data-shop="<?= $transaksi['shop']; ?>">
                            <i class="fa-solid fa-pencil"></i> Edit
                        </button>
                        <button class="hapus btn btn-danger my-0" data-bs-toggle="modal" data-bs-target="#modal-delete"
                            data-id="<?= $transaksi['id']; ?>" data-prod="<?= $transaksi['name']; ?>" data-harga="<?= $transaksi['harga']; ?>"
                            data-shop="<?= $transaksi['shop']; ?>">
                            <i class="fa-solid fa-trash"></i> Hapus
                        </button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Modal Edit -->
    <div class="modal fade" tabindex="-1" id="modal-edit" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <form id="edit-link" method="post" enctype="multipart/form-data" class="modal-content needs-validation" novalidate>
                <div class="modal-header bg-pink text-white">
                    <h5 class="modal-title" id="modal-edit-head">Menu Edit</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>">
                    <div>
                        <span class="badge bg-secondary" id="prodIcon">Secondary</span>
                        <span class="badge bg-info text-dark" id="shopIcon">Info</span>
                    </div>
                    <div>
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
                    <button type="submit" class="btn btn-pink">Update Data</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Delete -->
    <div class="modal fade" tabindex="-1" id="modal-delete" aria-labelledby="hapusModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="modal-delete-head"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="delete-link" class="modal-footer" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>">
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    /* General Styling */
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f9f9f9;
        color: #333;
    }

    .btn-pink {
        background-color: #f7a9c7; /* Soft pink */
        color: white;
        font-weight: bold;
        border-radius: 25px;
        padding: 12px 30px;
        transition: background-color 0.3s ease;
        border: none;
    }

    .btn-pink:hover {
        background-color: #f1a0c5; /* Lighter pink on hover */
    }

    .table th, .table td {
        padding: 12px;
        text-align: center;
        vertical-align: middle;
    }

    .modal-header {
        border-radius: 15px 15px 0 0;
        padding: 10px;
    }

    .modal-content {
        border-radius: 15px;
    }

    /* Edit and Delete Buttons */
    .edit, .hapus {
        border-radius: 25px;
        padding: 10px 20px;
        font-size: 1rem;
    }

    .edit {
        background-color: #007bff;
        color: white;
    }

    .edit:hover {
        background-color: #0056b3;
    }

    .hapus {
        background-color: #dc3545;
        color: white;
    }

    .hapus:hover {
        background-color: #c82333;
    }

    .badge {
        font-size: 0.9rem;
        padding: 8px 20px;
        border-radius: 20px;
    }

    .input-group-text {
        background-color: #f7a9c7;
        color: white;
        font-weight: bold;
        border-radius: 25px 0 0 25px; /* Rounded left corners */
    }

    /* Responsive Design */
    @media (max-width: 576px) {
        .btn-pink {
            font-size: 1rem;
            padding: 10px 20px;
        }

        .table th, .table td {
            font-size: 0.9rem;
            padding: 8px;
        }

        .modal-footer button {
            padding: 10px 15px;
        }

        .edit, .hapus {
            font-size: 0.8rem;
            padding: 5px 10px;
        }

        .input-group {
            font-size: 0.9rem;
        }
    }
</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    const phones = document.querySelectorAll('.phone');

    if (window.innerWidth <= 425) {
        phones.forEach(phone => {
            phone.classList.add('d-none');
        });
        
        const edits = document.getElementsByClassName('edit');
        for (let i = 0; i < edits.length; i++) {
            edits[i].className = "edit btn btn-info m-0 p-1 me-2";
            edits[i].innerHTML = "<i class='fa-solid fa-pencil'></i>";
        }

        const hapus = document.getElementsByClassName('hapus');
        for (let i = 0; i < hapus.length; i++) {
            hapus[i].className = "hapus btn btn-danger m-0 p-1";
            hapus[i].innerHTML = "<i class='fa-solid fa-trash'></i>";
        }
    }

    let formatter = new Intl.NumberFormat('en-US');

    document.addEventListener('DOMContentLoaded', function () {
        var modalEdit = document.getElementById('modal-edit');
        modalEdit.addEventListener('show.bs.modal', function (event) {
            var id = event.relatedTarget.getAttribute('data-id');
            var prod = event.relatedTarget.getAttribute('data-prod');
            var shop = event.relatedTarget.getAttribute('data-shop');
            var harga = event.relatedTarget.getAttribute('data-harga');
            let formattedAngka = formatter.format(harga);
            var link = `<?= BASEURL ?>/transaksi/update?id=${id}`;
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
            var link = `<?= BASEURL ?>/transaksi/delete?id=${id}`;
            document.getElementById('delete-link').setAttribute('action', link);
            document.getElementById('modal-delete-head').innerText = `${prod} | ${shop} | Rp${formattedAngka}`;
        });
    });

    (function () {
        'use strict'

        var forms = document.querySelectorAll('.needs-validation')

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
