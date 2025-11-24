<?php

class RisetDosenController extends Controller
{
    public function __construct()
    {
        Middleware::auth();
    }

    public function index()
    {
        $m = new RisetDosen();

        if ($_SESSION['user']['role'] === 'editor') {
            $data['riset'] = $m->getByDosen($_SESSION['user']['id_dosen']);
        } else {
            $data['riset'] = $m->getAll();
        }

        $this->view("admin/risetDosen/index", $data);
    }

    public function create()
    {
        $d = new Dosen();
        $data['dosen'] = $d->getAll();

        $this->view("admin/risetDosen/create", $data);
    }

    public function store()
    {
        $m = new RisetDosen();

        $m->create([
            $_POST['id_dosen'],
            $_POST['judul'],
            $_POST['tahun'],
            $_POST['sumber_dana']
        ]);

        $_SESSION['success'] = "Riset dosen berhasil ditambahkan.";
        header("Location: /admin/RisetDosen");
    }

    public function edit($id)
    {
        $r = new RisetDosen();
        $d = new Dosen();

        $data['riset'] = $r->find($id);
        $data['dosen'] = $d->getAll();

        $this->view("admin/risetDosen/edit", $data);
    }

    public function update($id)
    {
        $m = new RisetDosen();

        $m->updateRiset($id, [
            $_POST['id_dosen'],
            $_POST['judul'],
            $_POST['tahun'],
            $_POST['sumber_dana']
        ]);

        $_SESSION['success'] = "Riset dosen berhasil diperbarui.";
        header("Location: /admin/RisetDosen");
    }

    public function delete($id)
    {
        $m = new RisetDosen();
        $m->delete($id);

        $_SESSION['success'] = "Riset dosen berhasil dihapus.";
        header("Location: /admin/RisetDosen");
    }
}
