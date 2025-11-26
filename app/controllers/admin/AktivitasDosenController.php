<?php

class AktivitasDosenController extends Controller
{
    public function __construct()
    {
        Middleware::auth();
    }

    public function index()
    {
        $m = new AktivitasDosen();

        if ($_SESSION['user']['role'] === 'editor') {
            $data['aktivitas'] = $m->getByDosen($_SESSION['user']['id']);
        } else {
            $data['aktivitas'] = $m->getAll();
        }

        $this->view("admin/aktivitasDosen/index", $data);
    }

    public function create()
    {
        $d = new Dosen();
        $data['dosen'] = $d->getAll();

        $this->view("admin/aktivitasDosen/create", $data);
    }

    public function store()
    {
        $m = new AktivitasDosen();

        $m->create([
            $_POST['id'],
            $_POST['judul'],
            $_POST['jenis_aktivitas'],
            $_POST['tanggal'],
            $_POST['deskripsi']
        ]);

        $_SESSION['success'] = "Aktivitas berhasil ditambahkan";
        header("Location: /admin/AktivitasDosen");
    }

    public function edit($id)
    {
        $m = new AktivitasDosen();
        $d = new Dosen();

        $data['aktivitas'] = $m->find($id);
        $data['dosen'] = $d->getAll();

        $this->view("admin/aktivitasDosen/edit", $data);
    }

    public function update($id)
    {
        $m = new AktivitasDosen();

        $m->updateAktivitas($id, [
            $_POST['id'],
            $_POST['judul'],
            $_POST['jenis_aktivitas'],
            $_POST['tanggal'],
            $_POST['deskripsi']
        ]);

        $_SESSION['success'] = "Aktivitas berhasil diperbarui";
        header("Location: /admin/AktivitasDosen");
    }

    public function delete($id)
    {
        $m = new AktivitasDosen();
        $m->delete($id);

        $_SESSION['success'] = "Aktivitas berhasil dihapus";
        header("Location: /admin/AktivitasDosen");
    }
}
