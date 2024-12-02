<?php

class Home extends Controller
{
    public function index()
    {
        $data['judul'] = 'Home';
        $data['aktif'] = 0;
        $this->view('templates/header', $data);
        $this->view('home/index');
        $this->view('templates/footer');
    }

    public function cariKodeLoc($params)
    {
        // die(var_dump("hallo", $params));
        // echo json_encode( $params);
        // return json_encode($params);
        // echo json_encode(['pesan' => 'anda berhasil akses cari kode lokasi']);
        $data = $this->model('Transaksi_model')->getProdukLocsById($params['id']);
        echo  json_encode($data);
        // die($data);
        // echo  json_encode(['error' => 'no id']);
    }
}
