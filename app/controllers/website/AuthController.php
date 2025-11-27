<?php
class AuthController extends Controller
{
    public function index()
    {
        $this->view("admin/auth/login");
    }
    
    public function home()
    {
        $this->index();
    }
}
