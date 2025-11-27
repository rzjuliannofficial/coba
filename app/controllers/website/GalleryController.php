<?php
class GalleryController extends Controller
{
    public function index()
    {
        $data['products'] = $this->model('Produk')->getAll();
        $data['title'] = 'Lab Applied Informatics Polinema';

        $this->view("public/layouts/header", $data);
        $this->view("public/gallery/index", $data);
        $this->view("public/layouts/footer");
    }

    public function home()
    {
        $this->index();
    }
}
