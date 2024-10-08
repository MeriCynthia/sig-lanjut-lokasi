<?php 

class User_model {
    private $table = 'User';
    private $db;
    
    public function __construct(){
      $this->db = new Database;
    }
    public function getAllUser() {
        $this->db->query('SELECT * FROM '.$this->table);
        return $this->db->resultSet();
    }
    public function getUserById($id) {
        $this->db->query('SELECT * FROM '.$this->table." WHERE id = :id");
        $this->db->bind('id',$id);
        return $this->db->single();
    }

    public function getUserByEmailnPin($email,$pin) {
        $this->db->query('SELECT * FROM '.$this->table." WHERE email = :email AND pin = :pin");
        $this->db->bind('email',$email);
        $this->db->bind('pin',$pin);
        return $this->db->single();
    }

    public function getUserByEmailorTelp($email,$telp) {
        $this->db->query('SELECT * FROM '.$this->table." WHERE email = :email OR telp = :telp");
        $this->db->bind('email',$email);
        $this->db->bind('telp',$telp);
        return $this->db->single();
    }

    public function getAllImageFileNames() {
        $this->db->query('SELECT gambar FROM '.$this->table);
        return $this->db->resultSet();
    }

    public function getUserByFileName($gambar) {
        $this->db->query('SELECT gambar FROM '.$this->table." WHERE gambar = :gambar");
        $this->db->bind('gambar',$gambar);
        return $this->db->single();
    }

    public function tambahDataTopup($topup) {
        $user = $this->getUserById($_SESSION['user']['id']);
        $total = $user['saldo'] + intval($topup);
        $_SESSION['topup'] = "<br>saldo ".$user['nama']." sebesar ".$user['saldo']." + ".$topup." = \"".$total."\" <br>";
        $sql = "UPDATE ".$this->table." SET saldo = :saldo WHERE ".$this->table.".id = :id";
        $this->db->query($sql);
        $this->db->bind('id',$user['id']);
        $this->db->bind('saldo',$total);
        
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function tambahDataUser() {
        $sql = "INSERT INTO ".$this->table." (`id`, `nama`, `email`, `telp`, `pin`, `gambar`, `saldo`) VALUES (NULL, :nama, :email, :telp, :pin, :gambar, 0)";
        $this->db->query($sql);
        $this->db->bind('nama',$_SESSION['user']['nama']);
        $this->db->bind('email',$_SESSION['user']['email']);
        $this->db->bind('telp','0' . $_SESSION['user']['telp']);
        $this->db->bind('pin',$_SESSION['user']['pin']);
        $this->db->bind('gambar',$_SESSION['user']['gambar']);

        $this->db->execute();
        return $this->db->rowCount();
    }
}