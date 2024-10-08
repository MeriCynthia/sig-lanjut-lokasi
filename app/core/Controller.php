<?php 
// digunakan untuk menghubungkan views dan model secara templating
class Controller {
    public function view($view, $data=[]){
        require_once __DIR__.'/../views/'.$view.'.php';
    }
  
    public function model($model) {
      if(file_exists(__DIR__."/../app/models/".$model.".php")){
      }
        require_once '../app/models/'.$model.'.php';
        return new $model;
    }
}

// Fungsi untuk menambahkan flash message, dipakai di controllers
function set_flash_message($message, $type = 'success') {
    $_SESSION['flash_message'] = [
        'message' => $message,
        'type' => $type
    ];
}

// Fungsi untuk menampilkan flash message, in views
function display_flash_message() {
    if (isset($_SESSION['flash_message'])) {
        $message = $_SESSION['flash_message']['message'];
        $type = $_SESSION['flash_message']['type'];

        // Menampilkan pesan sesuai tipe (misalnya, success, error, warning)
        echo "<div class='alert alert-{$type}' role='alert'>{$message}</div>";

        // Hapus flash message setelah ditampilkan
        unset($_SESSION['flash_message']);
    }
}