<?php

?>
<h2>Daftar Paypod</h2>
<p>Silahkan daftarkan diri anda: </p>
<form action="" method="post" enctype="multipart/form-data">
    <label for="nama">Nama</label><br>
    <input type="text" id="nama" name="nama" value="<?=isset($_SESSION['user']['nama']) ? $_SESSION['user']['nama'] : '' ?>" required><br>
    <label for="email">Email</label><br>
    <input type="email" id="email" name="email" value="<?=isset($_SESSION['user']['email']) ? $_SESSION['user']['email'] : '' ?>" required><br>
    <label for="telp">Nomor HP</label><br>
    <span>+62 </span><input type="tel" id="telp" name="telp" required value="<?=isset($_SESSION['user']['telp']) ? $_SESSION['user']['telp'] : '' ?>" pattern="[1-9]{10,12}" minlength="10" maxlength="12" oninput="this.value=this.value.replace(/[^0-9]/g,'');"><br>
    <label for="pin">PIN anda</label><br>
    <input type="text" id="pin" name="pin" required value="<?=isset($_SESSION['user']['pin']) ? $_SESSION['user']['pin'] : '' ?>" minlength="6" maxlength="6" required size="6"><br>
    <label for="file">Masukkan Gambar : </label><br>
    <input type="file" name="gambar" id="file" accept=".png, .jpg, .jpeg"><br>
    <button type="submit" name="daftar">Daftar</button>
</form>