<?php

?>
<h2>Daftar Paypod</h2>
<p>Silahkan daftarkan diri anda: </p>
<form action="" method="post" enctype="multipart/form-data">
    <label for="nama">Nama</label><br>
    <input type="text" id="nama" name="nama" value="<?=isset($_SESSION['pengguna']['nama']) ? $_SESSION['pengguna']['nama'] : '' ?>" required><br>
    <label for="email">Email</label><br>
    <input type="email" id="email" name="email" value="<?=isset($_SESSION['pengguna']['email']) ? $_SESSION['pengguna']['email'] : '' ?>" required><br>
    <label for="telp">Nomor HP</label><br>
    <span>+62 </span><input type="tel" id="telp" name="telp" required value="<?=isset($_SESSION['pengguna']['telp']) ? $_SESSION['pengguna']['telp'] : '' ?>" pattern="[1-9]{10,12}" minlength="10" maxlength="12" oninput="this.value=this.value.replace(/[^0-9]/g,'');"><br>
    <label for="pin">PIN anda</label><br>
    <input type="text" id="pin" name="pin" required value="<?=isset($_SESSION['pengguna']['pin']) ? $_SESSION['pengguna']['pin'] : '' ?>" minlength="6" maxlength="6" required size="6"><br>
    <button type="submit" name="daftar">Daftar</button>
</form>