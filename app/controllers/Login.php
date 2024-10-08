<?php
class Login extends Controller
{
    public function index()
    {
        if (isset($_SESSION["user"])) {
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

            $_SESSION['user']['name'] = $_POST['name'];
            $_SESSION['user']['email'] = $_POST['email'];
            $_SESSION['user']['telp'] = strval($_POST['telp']);
            $_SESSION['user']['pin'] = $_POST['pin'];

            $user = $this->model('User_model')->getUserByEmailorTelp($_POST['email'], $_POST['telp']);
            if ($user) {
                echo "<script>
                    alert('Email atau No HP sudah terdaftar, Verifikasi Gagal');
                </script>";
            } else {


                // Get the original file name
                $originalFileName = $_FILES['gambar']['name'];
                $maxLength = 50; // Adjust this value according to your column size in the database

                // Ensure the file name is not too long
                if (strlen($originalFileName) > $maxLength) {
                    $ext = pathinfo($originalFileName, PATHINFO_EXTENSION);
                    // Truncate the file name and append the extension
                    $fileName = substr($originalFileName, 0, $maxLength - strlen($ext) - 1) . '.' . $ext;
                } else {
                    $fileName = $originalFileName;
                }


                if ($this->model('User_model')->getUserByFileName($fileName)) {
                    // Modify the last two characters of the existing file name
                    $ext = pathinfo($fileName, PATHINFO_EXTENSION);

                    // Remove the last two characters of the base name (before extension) and replace them
                    $baseName = pathinfo($fileName, PATHINFO_FILENAME);
                    $newBaseName = substr($baseName, 0, -2) . rand(10, 99); // Replace last 2 chars with random numbers

                    // Rebuild the file name with the new base name and extension
                    $fileName = $newBaseName . '.' . $ext;
                }

                // Get all file names from the /gambar/ directory
                $imageDirectory = './gambar/user/';
                $allFiles = scandir($imageDirectory);
                // Filter out '.' and '..' from the list of files
                $imageFiles = array_diff($allFiles, array('.', '..'));

                // Get all image file names from the database
                $imageFilesInDatabase = $this->model('User_model')->getAllImageFileNames();
                // die(var_dump($imageFilesInDatabase));
                // Convert the database results to an array of file names
                $databaseFiles = array_column($imageFilesInDatabase, 'gambar');
                if (count($databaseFiles) == 0) die("database empty?"); // mencegah semua data di file terhapus
                
                // Find the files that are in the directory but not in the database
                $filesToDelete = array_diff($imageFiles, $databaseFiles);
                // Loop through the files to delete and remove them
                foreach ($filesToDelete as $file) {
                    $filePath = $imageDirectory . $file;
                    if (is_file($filePath)) {
                        unlink($filePath);
                    }
                }

                $_SESSION['user']['gambar'] = $fileName;

                move_uploaded_file($_FILES['gambar']['tmp_name'], './gambar/user/' . $_SESSION['user']['gambar']);
                $this->model('User_model')->tambahDataUser();

                $_SESSION['user']['id'] = $this->model('User_model')->getUserByEmailorTelp($_SESSION['user']['email'], $_SESSION['user']['telp'])['id'];
                $_SESSION['data'] = $_SESSION['user'];
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
            $email = $_SESSION['user']['email'] = $_POST['email'];
            $pin = $_SESSION['user']['pin'] = $_POST['pin'];
            $url = BASEURL;

            if ($user = $this->model('User_model')->getUserByEmailnPin($email, $pin)) {
                $nama = $_SESSION['user']['name'] = $user['name'];
                $_SESSION['user']['gambar'] = $user['gambar'];
                $_SESSION['user']['telp'] = $user['telp'];
                $_SESSION['user']['id'] = $user['id'];

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
    }
}