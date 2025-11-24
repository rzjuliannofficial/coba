<?php

class PublikasiDosenController extends Controller
{
    public function __construct()
    {
        Middleware::auth();
    }

    public function index()
    {
        $m = new PublikasiDosen();

        if ($_SESSION['user']['role'] === 'editor') {
            $data['publikasi'] = $m->getByDosen($_SESSION['user']['id_dosen']);
        } else {
            $data['publikasi'] = $m->getAll();
        }

        $this->view("admin/publikasiDosen/index", $data);
    }

    public function create()
    {
        $dosenModel = new Dosen();
        $data['dosen'] = $dosenModel->getAll();

        $this->view("admin/publikasiDosen/create", $data);
    }

    public function store()
    {
        $m = new PublikasiDosen();

        $m->create([
            $_POST['id_dosen'],
            $_POST['judul'],
            $_POST['deskripsi'],
            $_POST['tahun'],
            $_POST['link_jurnal'],
            $_POST['kategori']
        ]);

        $_SESSION['success'] = "Publikasi berhasil ditambahkan";
        header("Location: /admin/PublikasiDosen");
    }

    public function edit($id)
    {
        $m = new PublikasiDosen();
        $d = new Dosen();

        $data['publikasi'] = $m->find($id);
        $data['dosen'] = $d->getAll();

        $this->view("admin/publikasiDosen/edit", $data);
    }

    public function update($id)
    {
        $m = new PublikasiDosen();

        $m->updatePublikasi($id, [
            $_POST['id_dosen'],
            $_POST['judul'],
            $_POST['deskripsi'],
            $_POST['tahun'],
            $_POST['link_jurnal'],
            $_POST['kategori']
        ]);

        $_SESSION['success'] = "Publikasi berhasil diperbarui";
        header("Location: /admin/PublikasiDosen");
    }

    public function delete($id)
    {
        $m = new PublikasiDosen();
        $m->delete($id);

        $_SESSION['success'] = "Publikasi berhasil dihapus";
        header("Location: /admin/PublikasiDosen");
    }
}
