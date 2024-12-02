<?php 

class User_model {
    private $db;
    
    public function __construct(){
      $this->db = new Database;
    }

    // untuk login
    public function getUserByEmailnPin($email,$pin) {
        // my problem change to number pgsql
        $this->db->query('SELECT * FROM pengguna WHERE email = ? AND pin = ?');
        $this->db->bind(1,$email);
        $this->db->bind(2,$pin);
        return $this->db->single();
    }

    // untuk daftar
    public function getUserByEmailorTelp($email,$telp) {
        $this->db->query("SELECT * FROM pengguna WHERE email = ? OR telp = ?");
        $this->db->bind(1,$email);
        $this->db->bind(2,$telp);
        return $this->db->single();
    }

    // tambah data user
    public function tambahDataUser() {
        // $sql = "INSERT INTO pengguna (`nama`, `email`, `telp`, `pin`) VALUES (:nama, :email, :telp, :pin)";
        $sql = "INSERT INTO pengguna (name, email, telp, pin) VALUES (?, ?, ?, ?)";
        $this->db->query($sql);
        $this->db->bind(1,$_SESSION["pengguna"]["name"]);
        $this->db->bind(2,$_SESSION["pengguna"]["email"]);
        $this->db->bind(3,$_SESSION["pengguna"]["telp"]);
        $this->db->bind(4,$_SESSION["pengguna"]["pin"]);

        $this->db->execute();
        return $this->db->rowCount();
    }
}