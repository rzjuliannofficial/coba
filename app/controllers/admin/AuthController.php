<?php

class AuthController extends Controller
{
    public function login()
    {
        $this->view('admin/auth/login');
    }

    public function doLogin()
    {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $userModel = new Users();
        $user = $userModel->findByUsername($username);

        if (!$user) {
            $_SESSION['error'] = "Username tidak ditemukan";
            return header("Location: /admin/login");
        }

        if (!password_verify($password, $user['password'])) {
            $_SESSION['error'] = "Password salah";
            return header("Location: /admin/login");
        }

        $_SESSION['user'] = [
            'id'       => $user['id'],
            'username' => $user['username'],
            'role'     => $user['role'],
            'id_dosen' => $user['id_dosen'] // penting untuk editor
        ];

        header("Location: /admin/dashboard");
    }

    public function register()
    {
        $dosenModel = new Dosen();
        $data['dosen'] = $dosenModel->getAll();
        $this->view('admin/auth/register', $data);
    }

    public function doRegister()
    {
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
        $idDosen  = $_POST['id_dosen'] ?? null;

        $userModel = new Users();

        if ($userModel->findByUsername($username)) {
            $_SESSION['error'] = "Username sudah digunakan";
            return header("Location: /admin/register");
        }

        if (!$idDosen) {
            $_SESSION['error'] = "Harus memilih dosen!";
            return header("Location: /admin/register");
        }

        $hash = password_hash($password, PASSWORD_DEFAULT);

        $userModel->create([
            'username' => $username,
            'password' => $hash,
            'role'     => 'editor',
            'id_dosen' => $idDosen
        ]);

        $_SESSION['success'] = "Registrasi berhasil! Silakan login.";
        header("Location: /admin/login");
    }

    public function logout()
    {
        session_unset();
        session_destroy();
        header("Location: /admin/login");
        exit;
    }
}
