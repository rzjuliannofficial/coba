<?php
class MemberController extends Controller
{
    public function index()
    {
        $data['team'] = $this->model('dosen')->getAll();
        $data['title'] = 'Lab Applied Informatics Polinema';

        $this->view("public/layouts/header", $data);
        $this->view("public/member/index", $data);
        $this->view("public/layouts/footer");
    }

    public function home()
    {
        $this->index();
    }
}

