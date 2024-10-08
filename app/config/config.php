<?php

// // 2 konfigurasi: untuk local [mysql] & (preview & production) [pgsql]
if (getenv('VERCEL_ENV') === 'production' || getenv('VERCEL_ENV') === 'preview') {
  // ambil nama url secara dinamis. using X-Forwarded-Proto header, which is set by Vercel to indicate whether the request was made over HTTPS.
  $protocol = (!empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') ? 'https://' : 'http://';
  $fullUrl = $protocol . $_SERVER['HTTP_HOST'];
  // define('BASEURL', $fullUrl);
  // define('BASEURL', 'http://localhost:8080/mm/public'); // hanya untuk testing


  $host = $_ENV['PG_HOST'] ?? "ep-frosty-haze-a1kda0nu.ap-southeast-1.aws.neon.tech";
  $port = $_ENV['PG_PORT'] ?? "5432";
  $db = $_ENV['PG_DB'] ?? "neondb";

  // define('DSN', "pgsql:host=$host;port=$port;dbname=$db;sslmode=require");
  define('DSN', "pgsql:host=ep-frosty-haze-a1kda0nu.ap-southeast-1.aws.neon.tech;port=5432;dbname=neondb;sslmode=require;options=endpoint=ep-frosty-haze-a1kda0nu");
  // define('DSN', "pgsql:host=ep-frosty-haze-a1kda0nu.ap-southeast-1.aws.neon.tech;port=5432;dbname=neondb;sslmode=verify-full;options=endpoint=ep-frosty-haze-a1kda0nu");
  // define('DSN', "pgsql:host=ep-frosty-haze-a1kda0nu.ap-southeast-1.aws.neon.tech;port=5432;dbname=neondb;sslmode=disable;options=endpoint=ep-frosty-haze-a1kda0nu");
  define('DB_USER', $_ENV['PG_USER'] ?? "neondb_owner");
  define('DB_PASS', $_ENV['PG_PASSWORD'] ?? "WDB1yOzHSk5R");
  define('DB_ENDPOINT', $_ENV['PG_ENDPOINT'] ?? "ep-frosty-haze-a1kda0nu");

  // postgresql://neondb_owner:WDB1yOzHSk5R@ep-frosty-haze-a1kda0nu.ap-southeast-1.aws.neon.tech/neondb?sslmode=require

} else {
    // echo "<script>
    //       alert('Database mySQL');
    //   </script>";
  define('DB_NOW_MYSQL', true);
  // sesuaikan nama url !!! hati-hati terhadap konfigurasi route ke server
  define('BASEURL', 'http://localhost:8080/mm/public'); // kita arahkan ke halaman public
  // var_dump($host, $port, $db, DB_USER, DB_PASS);
  define('DSN', "mysql:host=localhost:3306;dbname=poi_db;charset=utf8mb4");
  define('DB_USER', 'root');
  define('DB_PASS', '');
}
