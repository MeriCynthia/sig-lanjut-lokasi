<?php

class App
{
    private $controller = "Login";

    private $method = "index";
    private $params = [];

    public function __construct()
    {

        $url = $this->parseURL();
        // die(var_dump($url)); // ubah data menjadi tidak terlihat

        //cek data sesi login apa sudah terjadi, melalui apa ada data dalam session user
        if (isset($_SESSION['pengguna'])) {
            // berhasil masuk session user??
            // session user tidak berhasil masuk, tidak masuk
            // var_dump($_SESSION['pengguna']);
            // die();
            $this->controller = "Home"; // halaman default setelah login
            if (isset($url["object&Method"][0])) { // cek url kontroller sudah disebut
                $class = ucfirst($url["object&Method"][0]);
                if (file_exists(__DIR__ . '/../controllers/' . $class . '.php')) {
                    $this->controller = $class; // ganti kontroller home dengan yg disebut
                    unset($url["object&Method"][0]);
                }
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
        if (isset($url["object&Method"][1])) {
            // var_dump($this->controller, $url);
            if (method_exists($this->controller, $url["object&Method"][1])) {
                // echo "cek url[1], masuk controller dan method url[1] <br/>";
                $this->method = $url["object&Method"][1];
                // die(var_dump($url["object&Method"][1]));
                unset($url["object&Method"]);
            }
            // hilangan, supaya method ada default (the controller default)
            // else {
            //     // die("method {$url[1]} tidak ditemuka");
            // }
        }

        //cek apa ada sisa utk parameter
        if (!empty($url['params'])) {
            // echo "terdapat parameter<br/>";
            $this->params = array_values($url); // mengurutkan ulang index
            // die(var_dump($url['params']));
            // ini jalan
        }
        // die(var_dump($url));
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
        // Check if 'url' parameter is passed in the query string
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/'); // Remove trailing slashes
            $url = filter_var($url, FILTER_SANITIZE_URL); // Sanitize URL
            $urlParts = explode('/', $url); // Split URL into parts

            // Combine URL parts and query parameters into an array
            return [
                'object&Method' => $urlParts,
                'params' => array_slice($_GET, 1)
            ];
        }
        // If 'url' parameter is not found, check the REQUEST_URI (for production)
        if (isset($_SERVER['REQUEST_URI'])) {
            // Get URL without trailing slash
            $url = rtrim($_SERVER['REQUEST_URI'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL); // Sanitize URL
            $urlParts = explode('/', $url); // Split URL into parts
        
            // Remove empty values from the array and re-index the array
            $urlParts = array_values(array_filter($urlParts));
        
            // Parse query parameters from the request URI
            $queryParams = [];
            if (strpos($url, '?') !== false) {
                $queryString = parse_url($url, PHP_URL_QUERY); // Get query string part
                parse_str($queryString, $queryParams); // Parse query string into an associative array
        
                // Remove the query string part from the last part of the URL
                $urlParts = array_map(function($part) {
                    return explode('?', $part)[0];
                }, $urlParts);
            }
        
            // Returning the desired output structure: path parts and query params
            return [
                'object&Method' => array_slice($urlParts, 0, 2),
                'params' => $queryParams
            ];
        }

        // If no matching conditions, print debug info
        echo "<br/>tidak masuk ke kedua get dan server";
        var_dump($_GET);
        var_dump($_SERVER);
        die(var_dump("get url tidak jalan"));
    }
}