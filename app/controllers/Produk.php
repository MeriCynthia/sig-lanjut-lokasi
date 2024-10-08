<?php

class Produk extends Controller
{
    public function index()
    {
        $data['judul'] = 'Produk';
        $data['aktif'] = 1;
        $data['produk'] = $this->model('Produk_model')->getAllProduk();
        $_SESSION['data'] = $data['produk'];
        $this->view('templates/header', $data);
        $this->view('produk/index', $data);
        $this->view('templates/footer');
    }

    public function create($id = null)
    {
        $data['judul'] = 'Produk';
        $data['aktif'] = 1;
        $data['id'] = $id;
        $this->view('templates/header', $data);
        $this->view('produk/tambah', $data);
        $this->view('templates/footer');
    }

    public function post()
    {
        // Ketika form dikirim, Anda bisa memverifikasi token ini di server
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
                die("Invalid CSRF token.");
            }
            unset($_POST["csrf_token"]);
            
            $id = $_POST['id'];
            $name = $_POST['name'];

            $produk = [
                'id' => $id,
                'name' => $name
            ];
            $row = $this->model('Produk_model')->tambahDataProduk($produk);  // Mengembalikan 1 untuk INSERT baru, atau 2 jika terjadi UPDATE

            if ($row == 1) {
                set_flash_message('Data berhasil disimpan 🤩!', 'success');
            } else if ($row === 2) {
                set_flash_message('Data ['.$id.'] Sudah Ada 😆!nama diubah ['.$name.']', 'info');
            } else {
                set_flash_message('Data Id dan Nama Sudah ada 🤡!', 'warning');
            }
            header("Location: " . BASEURL . "/produk/create");
            exit();
        }
    }

    public function edit($id)
    {
        $data['judul'] = 'Produk';
        $data['aktif'] = 1;
        $data['product'] = $this->model('Produk_model')->getProdukById();
        $data['id'] = $id;
        $this->view('templates/header', $data);
        $this->view('produk/edit', $data);
        $this->view('templates/footer');
    }

    public function update($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Periksa apakah metode sebenarnya adalah PUT
            if (isset($_POST['_method']) && $_POST['_method'] === 'PUT') {
                // Perlakukan ini sebagai permintaan PUT
                if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
                    die("Invalid CSRF token.");
                }
                unset($_POST["csrf_token"]);

                if ($this->model('Produk_model')->updateProductById($id, $_POST['name']) > 0) {
                    set_flash_message('Data berhasil Diupdate 🤩!', 'success');
                } else {
                    set_flash_message('Data gagal Diupdate 😢!', 'danger');
                }
            }
        }
        header("Location: " . BASEURL . "/produk");
        exit();
    }

    public function delete($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
                die("Invalid CSRF token.");
            }
            unset($_POST["csrf_token"]);

            if (isset($_POST['_method']) && $_POST['_method'] === 'DELETE') {
                if ($this->model('Produk_model')->deleteProductById($id) > 0) {
                    set_flash_message('Data berhasil Dihapus 🤩!', 'success');
                } else {
                    set_flash_message('Data gagal Dihapus 😢!', 'danger');
                }
            }
        }
        header("Location: " . BASEURL . "/produk");
        exit();
    }
}
