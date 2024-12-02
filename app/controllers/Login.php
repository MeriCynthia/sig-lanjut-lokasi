<?php
class Login extends Controller
{
    public function index()
    {
        if (isset($_SESSION['pengguna'])) {
            session_unset();
        }
        $data['judul'] = 'Login';
        $this->view('templates/header_login', $data);
        $this->view('login/index');
        $this->view('templates/footer');
    }
    public function daftar()
    {
        $data['judul'] = 'Login/Daftar';

        if (isset($_POST['daftar'])) {
            // die(var_dump($_POST));
            $_SESSION['pengguna']['name'] = $_POST['name'];
            $_SESSION['pengguna']['email'] = $_POST['email'];
            $_SESSION['pengguna']['telp'] = strval($_POST['telp']);
            $_SESSION['pengguna']['pin'] = $_POST['pin'];

            $user = $this->model('User_model')->getUserByEmailorTelp($_POST['email'], $_POST['telp']);
            if ($user) {
                echo "<script>
                    alert('Email atau No HP sudah terdaftar, Verifikasi Gagal');
                </script>";
            } else {

                $this->model('User_model')->tambahDataUser();

                $_SESSION['pengguna']['id'] = $this->model('User_model')->getUserByEmailorTelp($_SESSION['pengguna']['email'], $_SESSION['pengguna']['telp'])['id'];
                $_SESSION['data'] = $_SESSION['pengguna'];
                header("Location: " . BASEURL . "/home");
                exit;
            }
        }

        $this->view('templates/header_login', $data);
        $this->view('login/daftar');
        $this->view('templates/footer');
    }

    public function verifikasi()
    {
        if (isset($_POST['login'])) {
            $email = $_SESSION['pengguna']['email'] = $_POST['email'];
            $pin = $_SESSION['pengguna']['pin'] = $_POST['pin'];
            $url = BASEURL;

            if ($user = $this->model('User_model')->getUserByEmailnPin($email, $pin)) {
                $nama = $_SESSION['pengguna']['name'] = $user['name'];
                $_SESSION['pengguna']['telp'] = $user['telp'];
                $_SESSION['pengguna']['id'] = $user['id'];

                echo "
                    <script>
                        alert('Verifikasi Berhasil! selamat datang $nama 😍');
                        document.location.href='$url/home';
                    </script>";
            } else {
                session_unset();
                echo "
                    <script>
                        alert('Verifikasi Gagal 😭! Silahkan perbaiki data atau daftarkan diri 📜');
                        document.location.href= '$url/'
                    </script>";
            }
        }
        // echo "<br/> gagal masuk url login/verfikasi";
        // die();
    }
}