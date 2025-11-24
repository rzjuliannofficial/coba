<?php

class KegiatanLabController extends Controller
{
    public function __construct()
    {
        Middleware::auth();
    }

    private function handleUpload($input = 'file_dokumentasi')
    {
        if (empty($_FILES[$input]) || $_FILES[$input]['error'] !== UPLOAD_ERR_OK) {
            return null;
        }

        $file = $_FILES[$input];
        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);

        $safe = "kegiatan_" . time() . "_" . bin2hex(random_bytes(5)) . "." . $ext;

        $destDir = realpath(__DIR__ . '/../../..') . "/public/uploads/kegiatan_lab/";

        if (!is_dir($destDir)) mkdir($destDir, 0777, true);

        return move_uploaded_file($file['tmp_name'], $destDir . $safe) ? $safe : null;
    }

    public function index()
    {
        $m = new KegiatanLab();

        if ($_SESSION['user']['role'] === 'editor') {
            $data['kegiatan'] = $m->getByDosen($_SESSION['user']['id_dosen']);
        } else {
            $data['kegiatan'] = $m->getAll();
        }

        $this->view("admin/kegiatanLab/index", $data);
    }

    public function create()
    {
        $d = new Dosen();
        $data['dosen'] = $d->getAll();

        $this->view("admin/kegiatanLab/create", $data);
    }

    public function store()
    {
        $file = $this->handleUpload();

        $m = new KegiatanLab();
        $m->create([
            $_POST['id_dosen'],
            $_POST['judul'],
            $_POST['deskripsi'],
            $_POST['tanggal_kegiatan'],
            $file
        ]);

        $_SESSION['success'] = "Kegiatan Lab berhasil ditambahkan.";
        header("Location: /admin/KegiatanLab");
    }

    public function edit($id)
    {
        $m = new KegiatanLab();
        $d = new Dosen();

        $data['kegiatan'] = $m->find($id);
        $data['dosen'] = $d->getAll();

        $this->view("admin/kegiatanLab/edit", $data);
    }

    public function update($id)
    {
        $m = new KegiatanLab();
        $old = $m->find($id);

        $file = $this->handleUpload();
        if (!$file) $file = $old['file_dokumentasi'];

        $m->updateData($id, [
            $_POST['id_dosen'],
            $_POST['judul'],
            $_POST['deskripsi'],
            $_POST['tanggal_kegiatan'],
            $file
        ]);

        $_SESSION['success'] = "Kegiatan Lab berhasil diperbarui.";
        header("Location: /admin/KegiatanLab");
    }

    public function delete($id)
    {
        $m = new KegiatanLab();
        $data = $m->find($id);

        if (!empty($data['file_dokumentasi'])) {
            $file = realpath(__DIR__ . '/../../..') . "/public/uploads/kegiatan_lab/" . $data['file_dokumentasi'];
            if (file_exists($file)) unlink($file);
        }

        $m->delete($id);

        $_SESSION['success'] = "Kegiatan Lab berhasil dihapus.";
        header("Location: /admin/KegiatanLab");
    }
}
