<?php

class FasilitasController extends Controller
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

    private function uploadFoto($input = 'foto')
    {
        if (empty($_FILES[$input]) || $_FILES[$input]['error'] !== UPLOAD_ERR_OK) {
            return null;
        }

        $f = $_FILES[$input];
        $ext = pathinfo($f['name'], PATHINFO_EXTENSION);

        $safe = "fasilitas_" . time() . "_" . bin2hex(random_bytes(5)) . "." . $ext;

        $dir = realpath(__DIR__ . '/../../..') . "/public/uploads/fasilitas/";
        if (!is_dir($dir)) mkdir($dir, 0777, true);

        return move_uploaded_file($f['tmp_name'], $dir . $safe) ? $safe : null;
    }

    public function index()
{
    $m = new Fasilitas();
    $data['fasilitas'] = $m->getAll();
    $this->view("admin/fasilitas/index", $data);
}

public function create()
{
    $this->view("admin/fasilitas/create");
}

    public function store()
    {
        $foto = $this->uploadFoto(); // FIXED

        $m = new Fasilitas();
        $id_fasilitas = $m->createAndReturnId([
            $_POST['nama_fasilitas'],
            $_POST['deskripsi'],
            $_POST['kondisi'],
            $foto
        ]);

        if ($foto && $this->isImageFile($foto)) {
            $g = new Galeri();
            $uploadedBy = $_SESSION['user']['id'] ?? null;

            $g->create([
                $uploadedBy,
                "fasilitas/" . $foto,
                "",
                null, null, null, null, null,
                $id_fasilitas
            ]);
        }

        $_SESSION['success'] = "Fasilitas berhasil ditambahkan.";
        header("Location: /admin/fasilitas");
    }


    public function edit($id)
{
    $m = new Fasilitas();
    $data['fasilitas'] = $m->find($id);
    $this->view("admin/fasilitas/edit", $data);
}

    public function update($id)
    {
        $m = new Fasilitas();
        $old = $m->find($id);

        $fotoBaru = $this->uploadFoto();

        if (!$fotoBaru) {
            $fotoBaru = $old['foto']; // FIXED
        }

        $m->updateData($id, [
            $_POST['nama_fasilitas'],
            $_POST['deskripsi'],
            $_POST['kondisi'],
            $fotoBaru
        ]);

        if ($fotoBaru !== $old['foto'] && $this->isImageFile($fotoBaru)) {
            $g = new Galeri();
            $uploadedBy = $_SESSION['user']['id'] ?? null;

            $g->create([
                $uploadedBy,
                "fasilitas/" . $fotoBaru,
                "",
                null, null, null, null, null,
                $id
            ]);
        }

        $_SESSION['success'] = "Fasilitas berhasil diperbarui.";
        header("Location: /admin/fasilitas");
    }
}
