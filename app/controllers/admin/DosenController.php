<?php

class DosenController extends Controller
{
    public function __construct()
    {
        Middleware::auth(); // editor + admin boleh
    }

    public function index()
    {
        $m = new Dosen();

        if ($_SESSION['user']['role'] === 'editor') {
            $dosen = $m->find($_SESSION['user']['id']);
            if (!$dosen) {
                $_SESSION['error'] = "Akun editor tidak memiliki data dosen!";
                return header("Location: /admin/dashboard");
            }
            $data['dosen'] = [$dosen];
        } else {
            $data['dosen'] = $m->getAll();
        }

        $this->view('admin/dosen/index', $data);
    }

    public function create()
    {
        $this->view('admin/dosen/create');
    }

    private function handleUploadFoto($fileInputName = 'foto')
    {
        if (empty($_FILES[$fileInputName]) || $_FILES[$fileInputName]['error'] !== UPLOAD_ERR_OK) return null;

        $f = $_FILES[$fileInputName];
        $ext = pathinfo($f['name'], PATHINFO_EXTENSION);
        $safe = 'dosen_' . time() . '_' . bin2hex(random_bytes(4)) . '.' . $ext;
        $destDir = __DIR__ . '/../../public/uploads/dosen/';
        if (!is_dir($destDir)) mkdir($destDir, 0755, true);

        return move_uploaded_file($f['tmp_name'], $destDir . $safe) ? $safe : null;
    }

    public function store()
    {
        $nama = trim($_POST['nama'] ?? '');
        $nip  = trim($_POST['nip'] ?? '');
        $email= trim($_POST['email'] ?? '');
        if ($nama === '' || $nip === '' || $email === '') {
            $_SESSION['error'] = "Semua field wajib diisi.";
            return header("Location: /admin/dosen/create");
        }

        $foto = $this->handleUploadFoto('foto');

        $m = new Dosen();
        $m->create([
            'nama' => $nama,
            'nip'  => $nip,
            'email'=> $email,
            'foto' => $foto
        ]);

        $_SESSION['success'] = "Dosen berhasil ditambahkan.";
        header("Location: /admin/dosen");
    }

    public function edit($id)
    {
        $m = new Dosen();
        $dosen = $m->find($id);
        if (!$dosen) {
            $_SESSION['error'] = "Dosen tidak ditemukan.";
            return header("Location: /admin/dosen");
        }
        $this->view('admin/dosen/edit', ['dosen' => $dosen]);
    }

    public function update($id)
    {
        $nama = trim($_POST['nama'] ?? '');
        $nip  = trim($_POST['nip'] ?? '');
        $email= trim($_POST['email'] ?? '');
        if ($nama === '' || $nip === '' || $email === '') {
            $_SESSION['error'] = "Semua field wajib diisi.";
            return header("Location: /admin/dosen/edit/{$id}");
        }

        $foto = $this->handleUploadFoto('foto');

        $m = new Dosen();
        $m->updateDosen($id, [
            'nama' => $nama,
            'nip'  => $nip,
            'email'=> $email,
            'foto' => $foto
        ]);

        $_SESSION['success'] = "Dosen berhasil diperbarui.";
        header("Location: /admin/dosen");
    }

    public function delete($id)
    {
        $m = new Dosen();
        $row = $m->find($id);
        if ($row && !empty($row['foto_profil'])) {
            $file = __DIR__ . '/../../public/uploads/dosen/' . $row['foto_profil'];
            if (is_file($file)) @unlink($file);
        }
        $m->delete($id);
        $_SESSION['success'] = "Dosen berhasil dihapus.";
        header("Location: /admin/dosen");
    }
}
