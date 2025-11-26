<?php

class UserController extends Controller
{
    public function __construct()
    {
        Middleware::onlyAdmin(); // Hanya admin bisa manage user
    }

    public function index()
    {
        $users = new Users();
        $data['users'] = $users->getAllUsers();
        $this->view('admin/user/index', $data);
    }

    public function create()
{
    $dosenModel = new Dosen();
    $data['dosen'] = $dosenModel->getAll(); // sekarang sudah array siap loop
    $this->view('admin/user/create', $data);
}


    public function store()
    {
        $model = new Users();
        $username = trim($_POST['username']);
        $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $role = $_POST['role'];
        $idDosen = $_POST['id'] ?? null;

        if ($model->findByUsername($username)) {
            $_SESSION['error'] = "Username sudah digunakan!";
            return header("Location: /admin/user/create");
        }

        $model->create([
            'username' => $username,
            'password' => $pass,
            'role'     => $role,
            'id' => $idDosen
        ]);

        $_SESSION['success'] = "User berhasil ditambahkan!";
        header("Location: /admin/user");
    }

    public function edit($id)
{
    $model = new Users();
    $data['user'] = $model->getById($id);

    if (!$data['user']) {
        $_SESSION['error'] = "User tidak ditemukan!";
        return header("Location: /admin/user");
    }

    // Ambil semua dosen untuk dropdown
    $dosenModel = new Dosen();
    $data['dosens'] = $dosenModel->getAll(); // langsung array, tidak perlu pg_fetch_assoc

    $this->view('admin/user/edit', $data);
}



    public function update($id)
    {
        $model = new Users();
        $username = trim($_POST['username']);
        $role = $_POST['role'];
        $idDosen = $_POST['id'] ?? null;

        if (empty($_POST['password'])) {
            $model->updateUserNoPass($id, $username, $role, $idDosen);
        } else {
            $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $model->updateUser($id, $username, $pass, $role, $idDosen);
        }

        $_SESSION['success'] = "User berhasil diperbarui!";
        header("Location: /admin/user");
    }

    public function delete($id)
    {
        $model = new Users();
        $model->deleteUser($id);

        $_SESSION['success'] = "User berhasil dihapus!";
        header("Location: /admin/user");
    }
}

