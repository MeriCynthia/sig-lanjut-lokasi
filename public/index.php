<?php 

// menyimpan dan menampilkan data pesan error
ini_set('display_errors', 1); //menyimpan error (j)
ini_set('display_startup_errors', 1); //awal masuk display error secara umum
error_reporting(E_ALL); //menampilkan pesannya
session_start(); // inisialisasi $_SESSION; agar bisa diakses ke semua didalam server 

// Periksa apakah token CSRF sudah ada di sesi pengguna
if (empty($_SESSION['csrf_token'])) {
  // Jika belum ada, buat token CSRF yang unik
  $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

require_once __DIR__.'/../app/init.php';

$app = new App;

// // cek lingkungan pengembangan
// if (getenv('VERCEL_ENV') === 'production') {
//   // Kode untuk lingkungan produksi
//   echo "We're in production!";
// } elseif (getenv('VERCEL_ENV') === 'preview') {
//   // Kode untuk lingkungan preview
//   echo "We're in preview!";
// } else {
//   // Kode untuk lingkungan pengembangan
//   echo "We're in development!";
// }