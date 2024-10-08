<?php

class App
{
    private $controller = "Login";

    private $method = "index";
    private $params = [];

    public function __construct()
    {

        $url = $this->parseURL();
        // die(var_dump($url));

        //cek data sesi login apa sudah terjadi, melalui apa ada data dalam session user
        if (isset($_SESSION['user'])) {
            // berhasil masuk session user??
            // session user tidak berhasil masuk, tidak masuk
            // var_dump($_SESSION['user']);
            // die();
            $this->controller = "Home"; // halaman default setelah login
            if (isset($url[0])) { // cek url kontroller sudah disebut
                $url[0] = ucfirst($url[0]);
                if (file_exists(__DIR__ . '/../controllers/' . $url[0] . '.php')) {
                    $this->controller = $url[0]; // ganti kontroller home dengan yg disebut
                    unset($url[0]); // agar sisanya bisa dipakai method
                } 
                // hilangan, supaya Controller ada default (login or home)
                // else {
                //     // // hilangkan method ini nanti, supaya mengambil data default
                //     // echo "masuk url[0] yg harusnya Object Controller <br/>";
                //     // die(var_dump($url));
                // }
            }
        }

        require_once __DIR__ . "/../controllers/" . $this->controller . ".php";
        // buat objek yang akan memanggil construct masing"
        $this->controller = new $this->controller;

        // mengecek apakah param di set di url
        if (isset($url[1])) {
            // var_dump($this->controller, $url);
            if (method_exists($this->controller, $url[1])) {
                // echo "cek url[1], masuk controller dan method url[1] <br/>";
                // die(var_dump($url));
                $this->method = $url[1];
                unset($url[1]); // agar sisanya bisa dipakai params
            } 
            // hilangan, supaya method ada default (the controller default)
            // else {
            //     // die("method {$url[1]} tidak ditemuka");
            // }
        }

        //cek apa ada sisa utk parameter
        if (!empty($url)) {
            $this->params = array_values($url); // mengurutkan ulang index
            // echo "cek sisa lalu hapus <br/>";
            // die(var_dump($url));
            // ini jalan
        }
        //jalankan controller, method dan param jika
        // if (isset($this->method) && $url[1] == 'verifikasi') {
        //     echo "menjalankan semua array function, controller 👇<br/>";
        //     var_dump($this->controller);
        //     echo "menjalankan semua array function, method 👇<br/>";
        //     var_dump($this->method);
        //     echo "menjalankan semua array function, params 👇<br/>";
        //     var_dump($this->params);
        //     die();
        // }

        call_user_func_array([$this->controller, $this->method], $this->params);
        // try {
        // } catch (ErrorException $e) {
        //     die(var_dump($e->getMessage()));
        // }
        // die(var_dump($url, $result)); ini berhasil jalan
    }

    public function parseURL()
    {

        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        } else if (isset($_SERVER['REQUEST_URI'])) {
            // untuk production, kasus <server>/login/verifikasi. array(3) { [0]=> string(0) "" [1]=> string(5) "login" [2]=> string(10) "verifikasi" }
            // hilangkan array yang kosong
            $url = rtrim($_SERVER['REQUEST_URI'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            // array_filter(): Digunakan untuk menyaring elemen dari array, array_values(): Digunakan untuk mengatur ulang kunci array
            $url = array_values(array_filter($url));
            return $url;
        }
        echo "<br/>tidak masuk ke kedua get dan server";
        var_dump($_GET);
        var_dump($_SERVER);
        die(var_dump("get url tidak jalan"));
    }
}