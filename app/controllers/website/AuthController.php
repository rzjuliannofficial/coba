<?php
class AuthController extends Controller
{
    public function index()
    {
        $this->view("admin/auth/login");
    }

    public function register()
    {
        $this->view("admin/auth/register");
    }

    public function home()
    {
        $this->index();
    }
}
