<?php

class Produk_model
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }
    public function getAllProduk()
    {
        $sql = "SELECT * FROM produk";
        $this->db->query($sql);
        return $this->db->resultSet();
    }
    public function getProdukById($id)
    {
        $sql = "SELECT * FROM produk WHERE id = {$id}";
        $this->db->query($sql);
        return $this->db->single();
    }

    public function tambahDataProduk($produk)
    {
        if(DB_NOW_MYSQL) {
            $sql = "INSERT INTO produk (id, name) VALUES (:id, :nama)
            ON DUPLICATE KEY UPDATE name = VALUES(name)"; //versi mysql
        } else {
            $sql = "INSERT INTO produk (id, name) VALUES (:id, :nama)
            ON CONFLICT (id) DO UPDATE SET name = EXCLUDED.name";
        }

        $this->db->query($sql);
        $this->db->bind(':id', $produk['id']);
        $this->db->bind(':nama', $produk['name']);

        $this->db->execute();
        return $this->db->rowCount(); // Mengembalikan 0 Jika False(tidak terjadi perubahan, id dan value sama persis), 1 untuk INSERT baru, atau 2 jika terjadi UPDATE
    }

    public function updateProductById($id, $name)
    {
        $sql = "UPDATE produk SET name = :nama  WHERE id = :id";
        $this->db->query($sql);
        $this->db->bind(':id', $id);
        $this->db->bind(':nama', $name);

        $this->db->execute();
        return $this->db->rowCount();
    }

    public function deleteProductById($id)
    {
        $sql = "DELETE FROM produk WHERE id = :id";
        $this->db->query($sql);
        $this->db->bind(':id', $id);

        $this->db->execute();
        return $this->db->rowCount();
    }
}