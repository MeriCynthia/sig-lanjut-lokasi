<?php

class Database
{

  private $user = DB_USER;
  private $pass = DB_PASS;
  private $dsn = DSN;

  // private $endpoint = DB_ENDPOINT;

  private $dbh; // database handler
  private $stmt;

  public function __construct()
  {
    // Debugging
    // var_dump($this->dsn);

    // db jadi dinamis menyesuaikan mysql (local) atau postgre (preview & prod) 
    $option = [
      // PDO::ATTR_PERSISTENT => true, // tidak perlu koneksi berulang
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
      PDO::ATTR_EMULATE_PREPARES => false
    ];

    try {
      $this->dbh = new PDO($this->dsn, $this->user, $this->pass, $option);
      // die("database berhasil diakses");

    } catch (PDOException $e) {
      // Log error message with a timestamp
      die("Koneksi gagal guys 😭: " . $e->getMessage());
    }
  }

  public function query($query)
  {
    $this->stmt = $this->dbh->prepare($query);
  }

  public function bind($param, $value, $type = null)
  {
    if (is_null($type)) {
      switch (true) {
        case is_int($value):
          $type = PDO::PARAM_INT;
          break;
        case is_bool($value):
          $type = PDO::PARAM_BOOL;
          break;
        case is_null($value):
          $type = PDO::PARAM_NULL;
          break;
        default:
          $type = PDO::PARAM_STR;
      }
    }

    $this->stmt->bindValue($param, $value, $type);
  }

  public function execute()
  {
    $this->stmt->execute();
  }

  public function resultSet()
  {
    $this->execute();
    return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function single()
  {
    $this->execute();
    return $this->stmt->fetch(PDO::FETCH_ASSOC);
  }

  // fungsi untuk mengecek jika terjadi error
  public function rowCount()
  {
    return $this->stmt->rowCount();
  }
}