<?php

if (isset($_ENV['ENV']) && $_ENV['ENV'] == 'production') {
  define('BASEURL', $_ENV['APP_URL']);

  define('DB_HOST', $_ENV['PG_HOST']);
  define('DB_NAME', 'poi_db');
  define('DB_USER', 'root');
  define('DB_PASS', '');

  $host = $_ENV['PG_HOST'];
  $port = $_ENV['PG_PORT'];
  $db = $_ENV['PG_DB'];
  $user = $_ENV['PG_USER'];
  $password = $_ENV['PG_PASSWORD'];
  // $endpoint = $_ENV['PG_ENDPOINT'];

  try {
    $dsn = "pgsql:host=$host;port=$port;dbname=$db;sslmode=require";
    
    // make a database connection
    $pdo = new PDO($dsn, $user, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
  
  } catch (PDOException $e) {
    die("Connection failed: ".$e->getMessage());
  }

  // $connection_string = "host=" . $host . " port=" . $port . " dbname=" . $db . " user=" . $user . " password=" . $password . " options='endpoint=" . $endpoint . "' sslmode=require";

  // $dbconn = pg_connect($connection_string);

  // if (!$dbconn) {
  //   die("Connection failed: " . pg_last_error());
  // }
  // echo "Connected successfully";
} else {
  // sesuaikan nama url
  define('BASEURL', 'http://localhost:8080/mm/public');
  // DB
  define('DB_HOST', 'localhost:3306');
  define('DB_NAME', 'poi_db');
  define('DB_USER', 'root');
  define('DB_PASS', '');
}
