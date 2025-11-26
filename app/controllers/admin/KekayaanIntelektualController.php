<?php

class KekayaanIntelektualController extends Controller
{
    public function __construct()
    {
        Middleware::auth();
    }

    public function index()
    {
        $m = new KekayaanIntelektual();

        if ($_SESSION['user']['role'] === 'editor') {
            $data['ki'] = $m->getByDosen($_SESSION['user']['id_dosen']);
        } else {
            $data['ki'] = $m->getAll();
        }

        $this->view("admin/kekayaanIntelektual/index", $data);
    }

    public function create()
    {
        $d = new Dosen();
        $data['dosen'] = $d->getAll();

        $this->view("admin/kekayaanIntelektual/create", $data);
    }

    public function store()
    {
        $m = new KekayaanIntelektual();

        $m->create([
            $_POST['id_dosen'],
            $_POST['judul'],
            $_POST['no_permohonan'],
            $_POST['tahun']
        ]);

        $_SESSION['success'] = "Data Kekayaan Intelektual berhasil ditambahkan.";
        header("Location: /admin/KekayaanIntelektual");
    }

    public function edit($id)
    {
        $m = new KekayaanIntelektual();
        $d = new Dosen();

        $data['ki'] = $m->find($id);
        $data['dosen'] = $d->getAll();

        $this->view("admin/kekayaanIntelektual/edit", $data);
    }

    public function update($id)
    {
        $m = new KekayaanIntelektual();

        $m->updateKI($id, [
            $_POST['id_dosen'],
            $_POST['judul'],
            $_POST['no_permohonan'],
            $_POST['tahun']
        ]);

        $_SESSION['success'] = "Data Kekayaan Intelektual berhasil diperbarui.";
        header("Location: /admin/KekayaanIntelektual");
    }

    public function delete($id)
    {
        $m = new KekayaanIntelektual();
        $m->delete($id);

        $_SESSION['success'] = "Data Kekayaan Intelektual berhasil dihapus.";
        header("Location: /admin/KekayaanIntelektual");
    }
}
