<form action="<?= BASEURL; ?>/login" method="post">
    <button class="btn btn-danger m-2" name="logout">LOGOUT</button>
</form>

<h1>Selamat datang </h1>
<ul class="list-group">
    <li class="list-group-item">Nama:
        <?= $_SESSION['user']['name']; ?>
    </li>
    <li class="list-group-item">Email:
        <?= $_SESSION['user']['email']; ?>
    </li>
    <li class="list-group-item">No HP:
        <?= $_SESSION['user']['telp']; ?>
    </li>
    <li class="list-group-item">PIN:
        <?= $_SESSION['user']['pin']; ?>
    </li>
    <li class='list-group-item'>Gambar: <br>
        <img src="<?= BASEURL; ?>/gambar/user/<?= $_SESSION['user']['gambar']; ?>"
            alt="<?= $_SESSION['user']['gambar']; ?>" width="100">
        <form action="" method="post" enctype="multipart/form-data">
            <label for="gambar">Update Gambar</label>
            <input type="file" name="gambar" id="gambar" accept=".png, .jpg, .jpeg" oninput="showButton()"><br>
            <button type="submit" name="update_gambar" class="btn btn-secondary d-none" id="updateButton">Update</button>
        </form>
    </li>
</ul>
<script>
    function showButton() {
        // Get the file input element
        var fileInput = document.getElementById('gambar');
        // Get the button element
        var updateButton = document.getElementById('updateButton');

        // Check if the input has a file
        if (fileInput.files.length > 0) {
            // Show the button if a file is selected
            updateButton.classList.remove('d-none');
        } else {
            // Hide the button if no file is selected
            updateButton.classList.add('d-none');
        }
    }
</script>