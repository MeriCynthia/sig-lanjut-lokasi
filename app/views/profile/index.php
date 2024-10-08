<form action="<?= BASEURL; ?>/login" method="post">
    <button class="btn btn-danger m-2" name="logout">LOGOUT</button>
</form>

<h1>Selamat datang </h1>
<ul class="list-group">
    <li class="list-group-item">Nama:
        <?= $_SESSION['pengguna']['name']; ?>
    </li>
    <li class="list-group-item">Email:
        <?= $_SESSION['pengguna']['email']; ?>
    </li>
    <li class="list-group-item">No HP:
        <?= $_SESSION['pengguna']['telp']; ?>
    </li>
    <li class="list-group-item">PIN:
        <?= $_SESSION['pengguna']['pin']; ?>
    </li>
</ul>