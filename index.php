<?php
include_once __DIR__.'/app/config/config.php';

// halama ini hanya dipakai di Local Production
// atur alamat server dan database di app/config/config.php
// hiasan dari var_dump di datas layar sebagai informasi halaman, tidak apa jika dihapus. letaknya di app/view/templates/header atau app/controllers
header("Location: " . BASEURL);
exit;