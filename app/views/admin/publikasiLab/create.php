<?php ob_start(); ?>

<h1 class="text-2xl font-bold mb-6">Tambah Publikasi Lab</h1>

<form action="/admin/PublikasiLab/store" method="POST" enctype="multipart/form-data"
      class="bg-white p-6 rounded-lg shadow w-full max-w-3xl">

    <label class="block font-semibold mb-1">Dosen</label>
    <select name="id_dosen" class="w-full p-2 border rounded mb-4">
        <?php foreach ($dosen as $d): ?>
            <option value="<?= $d['id'] ?>"><?= htmlspecialchars($d['nama']) ?></option>
        <?php endforeach; ?>
    </select>

    <label class="block font-semibold mb-1">Judul</label>
    <input type="text" name="judul" class="w-full p-2 border rounded mb-4">

    <label class="block font-semibold mb-1">Deskripsi</label>
    <textarea name="deskripsi" class="w-full p-2 border rounded mb-4"></textarea>

    <label class="block font-semibold mb-1">Kategori</label>
    <input type="text" name="kategori" class="w-full p-2 border rounded mb-4">

    <label class="block font-semibold mb-1">Upload Dokumen (PDF, DOC, ZIP)</label>
    <input type="file" name="file_dokumen" class="w-full mb-4">

    <button class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
</form>

<?php
$content = ob_get_clean();
include "../app/views/admin/layouts/master.php";
?>
