<?php
class HomeController extends Controller {
    public function index() {
        $data['products']= $this->modelWebsite('ProductModel')->fetchProduct();
        $data['team']= $this->modelWebsite('MemberModel')->fetchTeam();
        $data['news']= $this->modelWebsite('NewsModel')->fetchNews();
        $data['title'] = 'Lab Applied Informatics Polinema';
        $this->view("public/layouts/header", $data); 
        $this->view("public/home/index", $data);
        $this->view("public/layouts/footer");
    }
}