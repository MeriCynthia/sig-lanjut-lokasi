<?php

class Toko_model
{
  private $db;

  public function __construct()
  {
    $this->db = new Database;
  }
  public function getAllToko()
  {
    $this->db->query("SELECT * FROM toko");
    return $this->db->resultSet();
  }

  public function getTokoById($id)
  {
    $sql = "SELECT * FROM toko WHERE id = {$id}";
    $this->db->query($sql);
    return $this->db->single();
  }

  public function tambahToko($newToko)
  {
    $sql = "INSERT INTO toko (`name`, `alamat`, `lat`, `lng`) 
      VALUES (:name, :alamat, :lat, :lng)";

    // Menyiapkan query
    $this->db->query($sql);

    // Bind parameter dengan data dari array
    $this->db->bind(':name', $newToko['name']);
    $this->db->bind(':alamat', $newToko['alamat']);
    $this->db->bind(':lat', $newToko['lat']);
    $this->db->bind(':lng', $newToko['lng']);

    $this->db->execute();
    return $this->db->rowCount(); // Mengembalikan 0 Jika False(tidak terjadi perubahan, id dan value sama persis), 1 untuk INSERT baru, atau 2 jika terjadi UPDATE
  }

  public function updateTokoById($id, $newToko)
  {
    // die(var_dump($id, $newToko));
    $sql = "UPDATE toko SET `name` = :name, `alamat` = :name, `lat` = :lat, `lng` = :lng  WHERE `id` = :id";
    $this->db->query($sql);
    $this->db->bind(':id', $id);
    $this->db->bind(':name', $newToko['name']);
    $this->db->bind(':alamat', $newToko['alamat']);
    $this->db->bind(':lat', $newToko['lat']);
    $this->db->bind(':lng', $newToko['lng']);

    $this->db->execute();
    return $this->db->rowCount();
  }

  public function deleteTokoById($id)
  {
    $sql = "DELETE FROM toko WHERE `id` = :id";
    $this->db->query($sql);
    $this->db->bind(':id', $id);

    $this->db->execute();
    return $this->db->rowCount();
  }
}