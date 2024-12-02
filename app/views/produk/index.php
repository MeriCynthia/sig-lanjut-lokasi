<?php
// Tampilkan flash message jika ada
display_flash_message();
?>
<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f9f9f9;
        color: #333;
    }

    .btn-pink {
        background-color: #f7a9c7; /* Soft pink */
        color: white;
        border-radius: 25px;
        padding: 12px 24px;
        transition: background-color 0.3s ease;
        font-weight: bold;
        border: none;
    }

    .btn-pink:hover {
        background-color: #f1a0c5; /* Lighter pink on hover */
    }

    .card {
        border-radius: 15px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .card-body {
        background-color: #fff;
        padding: 20px;
    }

    .table-striped tbody tr:nth-of-type(odd) {
        background-color: #fafafa; /* Light grey background for odd rows */
    }

    .table th, .table td {
        padding: 15px;
        text-align: center;
    }

    .form-label {
        font-size: 1rem;
        font-weight: bold;
        color: #6f42c1; /* Soft purple */
    }

    .form-control {
        border-radius: 25px;
        border: 1px solid #e1e1e1;
        padding: 10px 20px;
    }

    .form-control:focus {
        border-color: #f7a9c7;
        box-shadow: 0 0 5px rgba(247, 169, 199, 0.5);
    }

    .modal-header {
        background-color: #f7a9c7;
        color: white;
    }

    .modal-content {
        border-radius: 15px;
    }

    .badge {
        background-color: #f7a9c7;
        color: white;
        font-size: 1rem;
        padding: 8px 20px;
        border-radius: 25px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    @media (max-width: 576px) {
        .btn-pink {
            font-size: 1rem;
            padding: 10px 20px;
        }

        .table th, .table td {
            font-size: 0.9rem;
        }

        .card-body {
            padding: 15px;
        }
    }
</style>
<a href="<?= BASEURL; ?>/produk/create" class="w-100 btn btn-icon btn-3 btn-pink m-2" type="button">
    <i class="fa-solid fa-plus"></i> Tambahkan Produk
</a>

<div class="table-responsive-md">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Barcode</th>
                <th>Nama</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data['produk'] as $produk): ?>
                <tr>
                    <td><?= $produk['id']; ?></td>
                    <td class="text-nowrap"><?= $produk['name']; ?></td>
                    <td class="align-middle text-center d-flex justify-content-evenly">
                        <button class="edit btn btn-info my-0" data-bs-toggle="modal" data-bs-target="#modal-edit"
                            data-id="<?= $produk['id']; ?>" data-name="<?= $produk['name']; ?>">Edit</button>
                        <button class="hapus btn btn-danger my-0" data-bs-toggle="modal" data-bs-target="#modal-delete"
                            data-id="<?= $produk['id']; ?>" data-name="<?= $produk['name']; ?>">Hapus</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Modal Edit -->
    <div class="modal fade" tabindex="-1" id="modal-edit" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <form id="edit-link" method="post" enctype="multipart/form-data" class="modal-content needs-validation" novalidate>
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-edit-head">Menu Edit</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>">
                    <div class="">
                        <label for="code" class="form-label">Code</label>
                        <input type="text" class="form-control" id="code" name="id" readonly>
                    </div>
                    <div class="">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                        <div class="invalid-feedback">Please provide a valid Name.</div>
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
                <div class="modal-header">
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
<script>
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

    document.addEventListener('DOMContentLoaded', function () {
        var modalEdit = document.getElementById('modal-edit');
        modalEdit.addEventListener('show.bs.modal', function (event) {
            var id = event.relatedTarget.getAttribute('data-id'); // Button that triggered the modal
            var name = event.relatedTarget.getAttribute('data-name'); // Button that triggered the modal
            var link = `<?= BASEURL ?>/produk/update?id=${id}`;
            console.log(link);
            document.getElementById('edit-link').setAttribute('action', link);
            document.getElementById('code').value = id;
            document.getElementById('name').value = name;
        });

        var modalHapus = document.getElementById('modal-delete');
        modalHapus.addEventListener('show.bs.modal', function (event) {
            var id = event.relatedTarget.getAttribute('data-id'); // Button that triggered the modal
            var name = event.relatedTarget.getAttribute('data-name'); // Button that triggered the modal
            var link = `<?= BASEURL ?>/produk/delete?id=${id}`;
            console.log(link);
            document.getElementById('delete-link').setAttribute('action', link);
            document.getElementById('modal-delete-head').innerText = `${id} | ${name}`;
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