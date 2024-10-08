<?php

class Database
{

  private $user = DB_USER;
  private $pass = DB_PASS;
  private $dsn = DSN;

  private $dbh; // database handler
  private $stmt;

  public function __construct()
  {
    // Debugging
    var_dump($this->dsn, DB_USER, DB_PASS);

    // db jadi dinamis menyesuaikan mysql (local) atau postgre (preview & prod) 
    $option = [
      PDO::ATTR_PERSISTENT => true,            // Gunakan koneksi persisten
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Lempar pengecualian untuk kesalahan
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC // Ambil hasil sebagai array asosiatif
    ];

    try {
      $this->dbh = new PDO($this->dsn, $this->user, $this->pass, $option);

    } catch (PDOException $e) {
      // Log error message with a timestamp
      error_log("Database connection error: " . $e->getMessage());
      // Display a user-friendly message without revealing sensitive information
      die('Database connection failed. Please try again later');
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