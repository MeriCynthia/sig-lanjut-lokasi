<?php

class App {
    private $controller = "Login";

    private $method = "index";
    private $params = [];

    public function __construct() {
        
        $url = $this->parseURL();
        // var_dump($url);
        
        //cek data sesi login apa sudah terjadi, melalui apa ada data dalam session user
        if(isset($_SESSION['user'])){
          $this->controller = "Home"; // halaman default setelah login
          if(isset($url[0])){ // cek url kontroller sudah disebut
              if(file_exists('../app/controllers/' . ucfirst($url[0]). '.php')) {
                  $this->controller = ucfirst($url[0]); // ganti kontroller home dengan yg disebut
                  unset($url[0]); // agar sisanya bisa dipakai params
              }
          }
        }
        
        require_once "../app/controllers/" . $this->controller . ".php";
        // buat objek yang akan memanggil construct masing"
        $this->controller = new $this->controller;

        // mengecek apakah param di set di url
        if(isset($url[1])) {
            // cek apakah method nya ada
            if(method_exists($this->controller, $url[1])){
                $this->method = $url[1];
                unset($url[1]); // agar sisanya bisa dipakai params
            }
        }

        //cek apa ada sisa utk parameter
        if(!empty($url)) {
            $this->params = array_values($url); // mengurutkan ulang index
        }
        
        //jalankan controller, method dan param jika
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    public function parseURL() {

        if(isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
    }
}