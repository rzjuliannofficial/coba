<?php
require_once __DIR__ . "/../../models/website/WebsiteModel.php";
require_once __DIR__ . "/../../models/website/ProductModel.php";
require_once __DIR__ . '/../../models/website/PublicationModel.php';
class HomeController extends Controller {
    public function home() {
        return $this->index();
    }
    // public function index(): void{
        //     // $data['nama'] = $this-> model('User_model')->getUser();
        //     $this->view('public/layouts/header', $data);
        //     $this->view('public/home/index');
        //     $this->view('public/layouts/footer');
        // }
        
        
        
    public function index() {
        // // ambil data team dari WebsiteModel
        // $team = WebsiteModel::fetchTeam();
        
        // // ambil data produk dari ProductModel
        // $productModel = new ProductModel();
        // $products = $productModel->getAll();
        
        // // ambil data produk dari PublicationModel
        // $publicationModel = new PublicationModel();
        // $publications = $publicationModel->getAll();
        
    $data['products']= $this->model('Produk')->getAll();
    $data['news']= $this->model('Berita')->getAll();
    $data['team']= $this->model('dosen')->getAll();
    $data['title'] = 'Lab Applied Informatics Polinema';
    $this->view("public/layouts/header", $data); 
    $this->view("public/home/index", $data);
    $this->view("public/layouts/footer");

    }
}