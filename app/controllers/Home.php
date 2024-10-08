<?php

class Home extends Controller
{
    public function index()
    {
        $data['judul'] = 'Home';
        $data['aktif'] = 0;
        if (isset($_GET['id'])) {
            $data = $this->model('Produk_model')->getProdukLocsById($_GET['id']);
            return $data;
        }
        else {
            $this->view('templates/header', $data);
            $this->view('home/index');
            $this->view('templates/footer');
        }
    }

    // public function locProd()
    // {
    //     if (isset($_GET['id'])) {
    //         $data = $this->model('Produk_model')->getProdukLocsById($_GET['id']);
    //         return $data;
    //     }
    //     return ['error' => 'no id'];
    // }
}
