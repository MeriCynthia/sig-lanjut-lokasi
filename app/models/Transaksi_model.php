<?php



class Transaksi_model
{
  private $table = 'transaksi';
  private $db;

  public function __construct()
  {
    $this->db = new Database;
  }
  public function getAllTransaksi()
  {
    $this->db->query("
      SELECT transaksi.id AS id, produk.id AS bar, produk.name AS name, transaksi.harga AS harga, toko.name AS shop 
      FROM transaksi JOIN produk ON transaksi.prod_id = produk.id JOIN toko ON transaksi.toko_id = toko.id
    ");
    return $this->db->resultSet();
  }

  public function tambahDataTransaksi($transaksi)
  {
    $prod_id = $transaksi['prod_id'];
    $toko_id = $transaksi['toko_id'];

    $sql = "SELECT * FROM transaksi WHERE prod_id = :pro_id AND toko_id = :tok_id";
    $this->db->query($sql);
    $this->db->bind('pro_id', $prod_id);
    $this->db->bind('tok_id', $toko_id);

    $this->db->execute();

    $cekData = $adaData = $this->db->single();
    if ($adaData) {
      // cek apakah sama persis, jika iya maka kirim badut
      unset($cekData["id"]);
      $cekDataBaru = array_merge($transaksi, ["user_id" => $_SESSION['user']['id']]);
      // die(var_dump($cekData, $cekDataBaru));
      if($cekData == $cekDataBaru) {
        return 0; // 0 untuk badut
      }

      // Jika ditemukan perbedaan, lakukan fungsi update
      return $this->updateDataTransaksi($adaData['id'], $transaksi);
    } else {

      // Query untuk menambah atau memperbarui transaksi, tanpa masalah
      $sql = "INSERT INTO " . $this->table . " (`prod_id`, `toko_id`, `harga`, `user_id`) 
      VALUES (:prod_id, :toko_id, :harga, :user_id)";

      // Menyiapkan query
      $this->db->query($sql);

      // Bind parameter dengan data dari array transaksi
      $this->db->bind(':prod_id', $transaksi['prod_id']);
      $this->db->bind(':toko_id', $transaksi['toko_id']);
      $this->db->bind(':harga', $transaksi['harga']);
      $this->db->bind(':user_id', $_SESSION['user']['id']);

      // Eksekusi query
      $this->db->execute();

      // Mengembalikan jumlah baris yang diubah
      return $this->db->rowCount(); // 1
    }
  }

  public function updateDataTransaksi($idLama, $baru)
  {
    // die(var_dump($idLama, $baru['harga'], $_SESSION['user']['id']));
    $sql = "UPDATE transaksi SET harga = :harg, user_id = :use_id WHERE id = :id_lama";
    $this->db->query($sql);
    $this->db->bind(':harg', $baru['harga']);
    $this->db->bind(':use_id', $_SESSION['user']['id']);
    $this->db->bind(':id_lama', $idLama);
    $this->db->execute();
    return 2; // tanda data diperbarui
  }

  public function deleteTransaksiById($id)
    {
        $sql = "DELETE FROM " . $this->table . " WHERE `id` = :id";
        $this->db->query($sql);
        $this->db->bind('id', $id);

        $this->db->execute();
        return $this->db->rowCount();
    }
}