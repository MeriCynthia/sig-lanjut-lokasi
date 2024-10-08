<?php
header("Access-Control-Allow-Origin:*");
header("Content-Type:application/json");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Request-With");

include '../../app/config/config.php';

$host = DB_HOST;
$user = DB_USER;
$pw = DB_PASS;
$db = DB_NAME;

try {
  $conn = new PDO("mysql:host=$host;dbname=$db", $user, $pw);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
} catch (PDOException $e) {
  // Log error instead of echoing
  error_log("Database connection failed: " . $e->getMessage());
  // Optionally display a user-friendly message
  echo "Database connection failed. Please try again later.";
  exit();
}

if (!isset($_GET['id'])) {
    http_response_code(404);
    echo json_encode(["error" => "Product Id not Found in URL"]);
    exit();
}

// Query untuk mengambil data PoI untuk megnhitung jarak
$stmt = $conn->prepare('
SELECT 
  produk.id AS bar,
  produk.name AS prod_name, 
  transaksi.harga AS harga, 
  toko.name AS name,
  toko.lat AS lat, 
  toko.lng AS lng
FROM 
    transaksi
JOIN 
    produk ON transaksi.prod_id = produk.id
JOIN 
    toko ON transaksi.toko_id = toko.id
WHERE
    transaksi.prod_id = :product_id
    ;
');
$stmt->bindParam(':product_id', $_GET['id'], PDO::PARAM_STR); //filter ID dilakukan setelah fetching

// Execute the statement
$stmt->execute();

if($stmt->rowCount() > 0) {
    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
} else {
    http_response_code(404);
    echo json_encode(["error" => "No Product Found in Database."]);
}