<?php 

class Toko extends Controller {
    public function index() {
        $data['judul'] = 'Toko';
        $data['aktif'] = 3;
        $data['toko'] = $this->model('Toko_model')->getAllToko();
        $_SESSION['data'] = $data['toko']; 
        $this->view('templates/header',$data);
        $this->view('toko/index',$data);
        $this->view('templates/footer');
    }

    // untuk api javascript di toko/create
    public function apiAllToko() {
        echo json_encode($this->model('Toko_model')->getAllToko());
    }


    public function create()
    {
        $data['judul'] = 'Toko';
        $data['aktif'] = 3;
        // ambil semua toko, tunjukkan koordinatnya di maps, not yet

        $this->view('templates/header', $data);
        $this->view('toko/tambah');
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
            // die(var_dump($_POST));

            $name = $_POST['name'];
            $alamat = $_POST['alamat'];

            $row = $this->model('Toko_model')->tambahToko($_POST);  // Mengembalikan 1 untuk INSERT baru, atau 2 jika terjadi UPDATE
            if ($row == 1) {
                set_flash_message('Data berhasil Di Tambahkan 🤩', 'success');
            } else {
                set_flash_message('Gagal Ditambahkan? Ada Yang Aneh 🤷', 'warning');
            }
            header("Location: " . BASEURL . "/toko/create");
            exit();
        }
    }

    public function edit($id)
    {
        $data['judul'] = 'Toko';
        $data['aktif'] = 3;
        $data['toko'] = $this->model('Toko_model')->getTokoById($id);
        $this->view('templates/header', $data);
        $this->view('toko/edit', $data);
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
                unset($_POST["csrf_token"], $_POST["_method"]);
                // die(var_dump($_POST));
                if ($this->model('toko_model')->updateTokoById($id, $_POST) > 0) {
                    set_flash_message('Data berhasil Diupdate 🤩!', 'success');
                } else {
                    set_flash_message('Data gagal Diupdate 😢!', 'danger');
                }
            }
        }
        header("Location: " . BASEURL . "/toko");
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
                if ($this->model('Toko_model')->deleteTokoById($id) > 0) {
                    set_flash_message('Data berhasil Dihapus 🤩!', 'success');
                } else {
                    set_flash_message('Data gagal Dihapus 😢!', 'danger');
                }
            }
        }
        header("Location: " . BASEURL . "/toko");
        exit();
    }
}
