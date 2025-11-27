<?php

class Home extends Controller {

    public function index()
    {
        // Set Judul Halaman
        $data['judul'] = 'Home';

        // Ambil data user (jika digunakan di header)
        $data['nama'] = $this->model('User_model')->getUser();

        // Ambil data produk (limit 3) melalui model
        $data['products'] = $this->model('Produk_model')->getLatestProducts(3);

        // Ambil data tim (limit 2) melalui model
        $data['team'] = $this->model('Dosen_model')->getTeam(2);

        // Muat Template
        $this->view('templates/header', $data);
        $this->view('home/index', $data);   // index.php sekarang menerima $products & $team
        $this->view('templates/footer');
    }
}
