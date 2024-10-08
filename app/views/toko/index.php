<?php
// Tampilkan flash message jika ada
display_flash_message();
?>
<a href="<?= BASEURL; ?>/toko/create" class="w-100 btn btn-icon btn-3 btn-success m-2" type="button">
    <i class="fa-solid fa-plus"></i> Tambahkan Toko</a>
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
                        <a class="edit btn btn-info my-0" href="<?= BASEURL ?>/toko/edit/<?= $toko['id'] ?>">Edit</a>
                        <button class="hapus btn btn-danger my-0" data-bs-toggle="modal" data-bs-target="#modal-delete"
                            data-id="<?= $toko['id']; ?>" data-name="<?= $toko['name']; ?>"
                            data-alamat="<?= $toko['alamat']; ?>">Hapus</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <!-- modal -->
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
<script>
    const phones = document.querySelectorAll('.phone');

    if (window.innerWidth <= 425) {
        // Use forEach to iterate through all selected elements
        phones.forEach(phone => {
            phone.classList.add('d-none');
        });
        const edits = document.getElementsByClassName('edit');
        for (let i = 0; i < edits.length; i++) {
            edits[i].className = "edit btn btn-info m-0 p-1 me-2";
            edits[i].innerHTML = "<i class='fa-solid fa-pencil'></i>";
            phones[i].classList.add('none');
        }
        const hapus = document.getElementsByClassName('hapus');
        for (let i = 0; i < hapus.length; i++) {
            hapus[i].className = "hapus btn btn-danger m-0 p-1";
            hapus[i].innerHTML = "<i class='fa-solid fa-trash'></i>";
        }
    }
    console.log(window.innerWidth);

    document.addEventListener('DOMContentLoaded', function () {
        var modalHapus = document.getElementById('modal-delete');
        modalHapus.addEventListener('show.bs.modal', function (event) {
            var id = event.relatedTarget.getAttribute('data-id');
            var name = event.relatedTarget.getAttribute('data-name');
            var alamat = event.relatedTarget.getAttribute('data-alamat');
            var link = `<?= BASEURL ?>/toko/delete/${id}`;
            console.log(link);
            document.getElementById('delete-link').setAttribute('action', link);
            document.getElementById('modal-delete-head').innerText = `${name} | ${alamat}`;
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