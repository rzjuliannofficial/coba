<?php

class PublikasiLabController extends Controller
{
    public function __construct()
    {
        Middleware::onlyAdmin(); 
    }

    private function isImageFile($filename)
    {
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        $allowed = ['jpg','jpeg','png','webp','gif'];
        return in_array($ext, $allowed);
    }

    private function uploadDokumen($input = 'file_dokumen')
    {
        if (empty($_FILES[$input]) || $_FILES[$input]['error'] !== UPLOAD_ERR_OK) {
            return null;
        }

        $f = $_FILES[$input];
        $ext = pathinfo($f['name'], PATHINFO_EXTENSION);

        $safe = "publikasi_lab_" . time() . "_" . bin2hex(random_bytes(5)) . "." . $ext;

        $dir = realpath(__DIR__ . '/../../..') . "/public/uploads/publikasi_lab/";
        if (!is_dir($dir)) mkdir($dir, 0777, true);

        return move_uploaded_file($f['tmp_name'], $dir . $safe) ? $safe : null;
    }

    public function index()
    {
        $m = new PublikasiLab();
        $data['publikasi'] = $m->getAll();

        $this->view("admin/publikasiLab/index", $data);
    }

    public function create()
    {
        $m = new Dosen();
        $data['dosen'] = $m->getAll();

        $this->view("admin/publikasiLab/create", $data);
    }

    public function store()
    {
        $file = $this->uploadDokumen();

        $m = new PublikasiLab();
        $id_publikasi = $m->createAndReturnId([
            $_POST['id'],
            $_POST['judul'],
            $_POST['deskripsi'],
            $file,
            $_POST['kategori']
        ]);

        // ===== MASUK GALERI (jika image) =====
        if ($file && $this->isImageFile($file)) {
            $uploadedBy = $_SESSION['user']['id'] ?? null;

            $g = new Galeri();
            $g->create([
                $uploadedBy,
                "publikasi_lab/" . $file,
                "",
                null,       // id_penelitian
                null,       // id_kegiatan_lab
                $id_publikasi, // id_publikasi_lab
                null,       // id_berita
                null,       // id_produk
                null
            ]);
        }

        $_SESSION['success'] = "Publikasi Lab berhasil ditambahkan.";
        header("Location: /admin/publikasiLab");
    }

    public function edit($id)
    {
        $m = new PublikasiLab();
        $data['publikasi'] = $m->find($id);

        $d = new Dosen();
        $data['dosen'] = $d->getAll();

        $this->view("admin/publikasiLab/edit", $data);
    }

    public function update($id)
    {
        $m = new PublikasiLab();
        $old = $m->find($id);

        $file = $this->uploadDokumen();
        if (!$file) $file = $old['file_dokumen'];

        $m->updateData($id, [
            $_POST['id'],
            $_POST['judul'],
            $_POST['deskripsi'],
            $file,
            $_POST['kategori']
        ]);

        if ($file !== $old['file_dokumen'] && $this->isImageFile($file)) {
            $uploadedBy = $_SESSION['user']['id'] ?? null;

            $g = new Galeri();
            $g->create([
                $uploadedBy,
                "publikasi_lab/" . $file,
                "",
                null,
                null,
                $id,
                null,
                null,
                null
            ]);
        }

        $_SESSION['success'] = "Publikasi Lab berhasil diperbarui.";
        header("Location: /admin/publikasiLab");
    }

    public function delete($id)
    {
        $m = new PublikasiLab();
        $old = $m->find($id);

        if (!empty($old['file_dokumen'])) {
            $path = realpath(__DIR__ . '/../../..') . "/public/uploads/publikasi_lab/" . $old['file_dokumen'];
            if (file_exists($path)) unlink($path);
        }

        $m->delete($id);

        $_SESSION['success'] = "Publikasi Lab berhasil dihapus.";
        header("Location: /admin/publikasiLab");
    }
}
