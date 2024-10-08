<?php

// "1,000" to 1000
function stringToInteger($str)
{
    // Menghapus semua koma dari string
    $str = str_replace(",", "", $str);

    // Mengubah string menjadi integer
    return intval($str);
}

class Transaksi extends Controller
{
    public function index()
    {
        $data['judul'] = 'Transaksi';
        $data['aktif'] = 2; // [0]home, [1]produk, [2]transaksi, [2]toko
        $data['transaksi'] = $this->model('Transaksi_model')->getAllTransaksi();
        $this->view('templates/header', $data);
        $this->view('transaksi/index', $data);
        $this->view('templates/footer');
    }

    public function tambah()
    {
        $data['judul'] = 'Transaksi';
        $data['aktif'] = 2;
        $data['produk'] = $this->model('Produk_model')->getAllProduk();
        $data['toko'] = $this->model('Toko_model')->getAllToko();
        $this->view('templates/header', $data);
        $this->view('transaksi/tambah', $data);
        $this->view('templates/footer');
    }

    public function post()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
                die("Invalid CSRF token.");
            }
            unset($_POST["csrf_token"]);
            $_POST['harga'] = stringToInteger($_POST['harga']);
            $_POST['toko_id'] = stringToInteger($_POST['toko_id']);

            $row = $this->model('Transaksi_model')->tambahDataTransaksi($_POST);  // Mengembalikan 1 untuk INSERT baru, atau 2 jika terjadi UPDATE
            // die(var_dump($row));
            if ($row == 1) {
                set_flash_message('Data berhasil disimpan 🤩!', 'success');
            } else if ($row == 2) {
                set_flash_message('Ditemukan riwayat lama, Data Diupdate 👍!', 'info');
            } else if ($row == 0) {
                set_flash_message('Tidak ada Data Baru 🤡!', 'warning');
            }
            $_SESSION['harga'] = number_format($_POST['harga'], 0, '.', ',');
            header("Location: " . BASEURL . "/transaksi/tambah");
            exit();
        }
    }

    public function update($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
                die("Invalid CSRF token.");
            }
            unset($_POST["csrf_token"]);
            
            // Periksa apakah metode sebenarnya adalah PUT
            if (isset($_POST['_method']) && $_POST['_method'] === 'PUT') {
                $_POST['harga'] = stringToInteger($_POST['harga']);

                $row = $this->model('Transaksi_model')->updateDataTransaksi($id, $_POST);  // Mengembalikan 1 untuk INSERT baru, atau 2 jika terjadi UPDATE
                if ($row == 2) {
                    set_flash_message('Data berhasil Diupdate 🤩!', 'success');
                } else {
                    set_flash_message('Data gagal Diupdate 😢!', 'danger');
                }
            }
        }
        header("Location: " . BASEURL . "/transaksi");
        exit();
    }

    public function delete($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Ketika form dikirim, Anda bisa memverifikasi token ini di server
            if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
                die("Invalid CSRF token.");
            }
            unset($_POST["csrf_token"]);

            if (isset($_POST['_method']) && $_POST['_method'] === 'DELETE') {
                if ($this->model('Transaksi_model')->deleteTransaksiById($id) > 0) {
                    set_flash_message('Data berhasil Dihapus 🤩!', 'success');
                } else {
                    set_flash_message('Data gagal Dihapus 😢!', 'danger');
                }
            }
        }
        header("Location: " . BASEURL . "/transaksi");
        exit();
    }
}
