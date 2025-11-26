<?php

class PenelitianLabController extends Controller
{
    public function __construct()
    {
        Middleware::auth();
    }

    public function index()
    {
        $m = new PenelitianLab();

        if ($_SESSION['user']['role'] === 'editor') {
            $data['penelitian'] = $m->getByDosen($_SESSION['user']['id_dosen']);
        } else {
            $data['penelitian'] = $m->getAll();
        }

        $this->view("admin/penelitianLab/index", $data);
    }

    public function create()
    {
        $d = new Dosen();
        $data['dosen'] = $d->getAll();

        $this->view("admin/penelitianLab/create", $data);
    }

    public function store()
    {
        $m = new PenelitianLab();

        $m->create([
            $_POST['id_dosen'],
            $_POST['judul'],
            $_POST['deskripsi'],
            $_POST['status']
        ]);

        $_SESSION['success'] = "Penelitian Lab berhasil ditambahkan.";
        header("Location: /admin/PenelitianLab");
    }

    public function edit($id)
    {
        $m = new PenelitianLab();
        $d = new Dosen();

        $data['penelitian'] = $m->find($id);
        $data['dosen'] = $d->getAll();

        $this->view("admin/penelitianLab/edit", $data);
    }

    public function update($id)
    {
        $m = new PenelitianLab();

        $m->updateData($id, [
            $_POST['id_dosen'],
            $_POST['judul'],
            $_POST['deskripsi'],
            $_POST['status']
        ]);

        $_SESSION['success'] = "Penelitian Lab berhasil diperbarui.";
        header("Location: /admin/PenelitianLab");
    }

    public function delete($id)
    {
        $m = new PenelitianLab();
        $m->delete($id);

        $_SESSION['success'] = "Penelitian Lab berhasil dihapus.";
        header("Location: /admin/PenelitianLab");
    }
}
