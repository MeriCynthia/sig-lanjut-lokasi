<a href="<?= BASEURL; ?>/toko/create" class="w-100 btn btn-icon btn-3 btn-pink m-2" type="button">
    <i class="fa-solid fa-plus"></i> Tambahkan Toko
</a>

<div class="table-responsive-md">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Alamat</th>
                <th class="phone">Koordinat</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data['toko'] as $toko): ?>
                <tr>
                    <td><?= $toko['name']; ?></td>
                    <td class="text-nowrap"><?= $toko['alamat']; ?></td>
                    <td class="text-nowrap phone"><?= $toko['lat']; ?> | <?= $toko['lng']; ?></td>
                    <td class="align-middle text-center d-flex justify-content-evenly">
                        <a class="edit btn btn-info my-0" href="<?= BASEURL ?>/toko/edit?id=<?= $toko['id'] ?>">Edit</a>
                        <button class="hapus btn btn-danger my-0" data-bs-toggle="modal" data-bs-target="#modal-delete"
                            data-id="<?= $toko['id']; ?>" data-name="<?= $toko['name']; ?>"
                            data-alamat="<?= $toko['alamat']; ?>">Hapus</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

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

<style>
    /* General Container */
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f9f9f9;
        color: #333;
    }

    .btn-pink {
        background-color: #f7a9c7; /* Soft pink */
        color: white;
        border-radius: 25px;
        padding: 12px 30px;
        transition: background-color 0.3s ease;
        font-weight: bold;
        border: none;
    }

    .btn-pink:hover {
        background-color: #f1a0c5; /* Lighter pink on hover */
    }

    .table {
        border-radius: 15px;
        background-color: #fff;
    }

    .table th, .table td {
        padding: 12px;
        text-align: center;
        vertical-align: middle;
    }

    .phone {
        font-size: 0.9rem;
    }

    .form-label {
        font-size: 1rem;
        font-weight: bold;
        color: #6f42c1; /* Soft purple */
    }

    .modal-header {
        background-color: #f7a9c7;
        color: white;
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

    /* Responsive Design */
    @media (max-width: 576px) {
        .phone {
            display: none; /* Hide phone number on small screens */
        }

        .edit, .hapus {
            font-size: 0.8rem;
            padding: 5px 10px;
        }

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
    }
</style>

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

    document.addEventListener('DOMContentLoaded', function () {
        var modalHapus = document.getElementById('modal-delete');
        modalHapus.addEventListener('show.bs.modal', function (event) {
            var id = event.relatedTarget.getAttribute('data-id');
            var name = event.relatedTarget.getAttribute('data-name');
            var alamat = event.relatedTarget.getAttribute('data-alamat');
            var link = `<?= BASEURL ?>/toko/delete?id=${id}`;
            document.getElementById('delete-link').setAttribute('action', link);
            document.getElementById('modal-delete-head').innerText = `${name} | ${alamat}`;
        });
    });
</script>
