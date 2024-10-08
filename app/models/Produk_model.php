<?php

class Produk_model
{
    private $table = 'produk';
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
        $sql = "INSERT INTO " . $this->table . " (`id`, `name`) VALUES (:id, :nama)
        ON DUPLICATE KEY UPDATE `name` = VALUES(`name`)";
        $this->db->query($sql);
        $this->db->bind('id', $produk['id']);
        $this->db->bind('nama', $produk['name']);

        $this->db->execute();
        return $this->db->rowCount(); // Mengembalikan 0 Jika False(tidak terjadi perubahan, id dan value sama persis), 1 untuk INSERT baru, atau 2 jika terjadi UPDATE
    }

    public function updateProductById($id, $name)
    {
        $sql = "UPDATE " . $this->table . " SET `name` = :nama  WHERE `id` = :id";
        $this->db->query($sql);
        $this->db->bind('id', $id);
        $this->db->bind('nama', $name);

        $this->db->execute();
        return $this->db->rowCount();
    }

    public function deleteProductById($id)
    {
        $sql = "DELETE FROM " . $this->table . " WHERE `id` = :id";
        $this->db->query($sql);
        $this->db->bind('id', $id);

        $this->db->execute();
        return $this->db->rowCount();
    }
}