<?php

class PpmController extends Controller
{
    public function __construct()
    {
        Middleware::auth();
    }

    public function index()
    {
        $m = new Ppm();

        if ($_SESSION['user']['role'] === 'editor') {
            $data['ppm'] = $m->getByDosen($_SESSION['user']['id_dosen']);
        } else {
            $data['ppm'] = $m->getAll();
        }

        $this->view("admin/ppm/index", $data);
    }

    public function create()
    {
        $d = new Dosen();
        $data['dosen'] = $d->getAll();

        $this->view("admin/ppm/create", $data);
    }

    public function store()
    {
        $m = new Ppm();

        $m->create([
            $_POST['id_dosen'],
            $_POST['judul'],
            $_POST['tahun']
        ]);

        $_SESSION['success'] = "PPM berhasil ditambahkan";
        header("Location: /admin/Ppm");
    }

    public function edit($id)
    {
        $ppm = new Ppm();
        $d = new Dosen();

        $data['ppm'] = $ppm->find($id);
        $data['dosen'] = $d->getAll();

        $this->view("admin/ppm/edit", $data);
    }

    public function update($id)
    {
        $m = new Ppm();

        $m->updatePpm($id, [
            $_POST['id_dosen'],
            $_POST['judul'],
            $_POST['tahun']
        ]);

        $_SESSION['success'] = "PPM berhasil diperbarui";
        header("Location: /admin/Ppm");
    }

    public function delete($id)
    {
        $m = new Ppm();
        $m->delete($id);

        $_SESSION['success'] = "PPM berhasil dihapus";
        header("Location: /admin/Ppm");
    }
}
