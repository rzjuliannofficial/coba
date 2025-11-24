<?php

class GaleriController extends Controller
{
    public function __construct()
    {
        Middleware::onlyAdmin(); // hanya admin bisa akses galeri
    }

    public function index()
    {
        $m = new Galeri();
        $data['galeri'] = $m->getAll();

        $this->view("admin/galeri/index", $data);
    }

    public function edit($id)
    {
        $m = new Galeri();
        $data['item'] = $m->find($id);

        if (!$data['item']) {
            $_SESSION['error'] = "Data galeri tidak ditemukan.";
            return header("Location: /admin/galeri");
        }

        $this->view("admin/galeri/edit", $data);
    }

    public function update($id)
    {
        $caption = trim($_POST['caption'] ?? "");

        $m = new Galeri();
        $m->updateCaption($id, $caption);

        $_SESSION['success'] = "Caption galeri berhasil diperbarui.";
        header("Location: /admin/galeri");
    }

    public function delete($id)
    {
        $m = new Galeri();
        $m->delete($id);

        $_SESSION['success'] = "Data galeri berhasil dihapus.";
        header("Location: /admin/galeri");
    }
}
