<div class="container">
    <h2>Login GIS</h2>
    <p>Masukkan data login anda: </p>
    <form action="<?=BASEURL;?>/login/verifikasi" method="post">
        <label for="email" >Email</label><br>
        <input type="email" value="a@a.a" id="email" name="email" required><br>
        <label for="pin">PIN anda</label><br>
        <input type="text" value="123456" id="pin" name="pin" required minlength="6" maxlength="6" required size="6"><br>
        <input type="checkbox" id="remember" name="remember">
        <label for="remember">Remember me</label><br>
        <button type="submit" name="login">log-in</button>
    </form>
    <p>atau <a href="<?=BASEURL;?>/login/daftar">daftarkan</a> diri anda</p>
</div>