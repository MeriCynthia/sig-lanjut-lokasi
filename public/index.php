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

// // "neondb_owner");
// // define('DB_PASS', $_ENV['PG_PASSWORD'] ?? "WDB1yOzHSk5R");
//  try {
//   $endpoint = $_ENV['PG_ENDPOINT'] ?? "ep-frosty-haze-a1kda0nu";
//   $mypd = new PDO("pgsql:host=ep-frosty-haze-a1kda0nu.ap-southeast-1.aws.neon.tech;port=5432;dbname=neondb;sslmode=require;options=endpoint=$endpoint", "neondb_owner", "WDB1yOzHSk5R"); 
//   echo "koneksi berhasil";
// } catch (PDOException $e) {
//   echo $e->getMessage();
//  }