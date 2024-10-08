<?php

// 2 konfigurasi: untuk local [mysql] & (preview & production) [pgsql]
if (getenv('VERCEL_ENV') === 'production' || getenv('VERCEL_ENV') === 'preview') {
  // ambil nama url secara dinamis. using X-Forwarded-Proto header, which is set by Vercel to indicate whether the request was made over HTTPS.
  $protocol = (!empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') ? 'https://' : 'http://';
  $fullUrl = $protocol . $_SERVER['HTTP_HOST'];

  define('BASEURL', $fullUrl);

  $host = $_ENV['PG_HOST'];
  $port = $_ENV['PG_PORT'];
  $db = $_ENV['PG_DB'];
  
  // $endpoint = $_ENV['PG_ENDPOINT']; // endpoint tidak dipakai
  // Data Source Name (DSN) bernilai dinamis
  define('DSN', "pgsql:host=$host;port=$port;dbname=$db;sslmode=require");
  define('DB_USER', $_ENV['PG_USER']);
  define('DB_PASS', $_ENV['PG_PASSWORD']);
  
} else {
  // sesuaikan nama url !!! hati-hati terhadap konfigurasi route ke server
  define('BASEURL', 'http://localhost:8080/mm-salin/public'); // kita arahkan ke halaman public

  define('DSN', "mysql:host=localhost:3306;dbname=poi_db;charset=utf8mb4");
  define('DB_USER', 'root');
  define('DB_PASS', '');
}
