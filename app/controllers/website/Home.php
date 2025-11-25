<?php

class Home extends Controller {
    public function index(): void{
        $data['title'] = 'Lab Applied Informatics Polinema';
        // $data['nama'] = $this-> model('User_model')->getUser();
        $this->view('public/layouts/header', $data);
        $this->view('public/home/index');
        $this->view('public/layouts/footer');
    }
}