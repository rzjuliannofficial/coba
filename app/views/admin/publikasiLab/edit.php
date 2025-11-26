<?php ob_start(); ?>

<h1 class="text-2xl font-bold mb-6">Edit Publikasi Lab</h1>

<form action="/admin/PublikasiLab/update/<?= $publikasi['id'] ?>" method="POST"
      enctype="multipart/form-data"
      class="bg-white p-6 rounded-lg shadow w-full max-w-3xl">

    <label class="block font-semibold mb-1">Dosen</label>
    <select name="id" class="w-full p-2 border rounded mb-4">
        <?php foreach ($dosen as $d): ?>
            <option value="<?= $d['id'] ?>"
                <?= $d['id'] == $publikasi['id'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($d['nama']) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label class="block font-semibold mb-1">Judul</label>
    <input type="text" name="judul" value="<?= htmlspecialchars($publikasi['judul']) ?>"
           class="w-full p-2 border rounded mb-4">

    <label class="block font-semibold mb-1">Deskripsi</label>
    <textarea name="deskripsi" class="w-full p-2 border rounded mb-4"><?= htmlspecialchars($publikasi['deskripsi']) ?></textarea>

    <label class="block font-semibold mb-1">Kategori</label>
    <input type="text" name="kategori" value="<?= htmlspecialchars($publikasi['kategori']) ?>"
           class="w-full p-2 border rounded mb-4">

    <label class="block font-semibold mb-1">Dokumen Baru (opsional)</label>
    <input type="file" name="file_dokumen" class="w-full mb-4">

    <?php if (!empty($publikasi['file_dokumen'])): ?>
        <p class="text-sm mb-2 font-semibold">Dokumen Saat Ini:</p>
        <a href="/uploads/publikasi_lab/<?= $publikasi['file_dokumen'] ?>" target="_blank"
           class="text-blue-600 underline text-sm">Lihat Dokumen</a>
    <?php endif; ?>

    <button class="bg-yellow-600 text-white px-4 py-2 rounded mt-4">Update</button>
</form>

<?php
$content = ob_get_clean();
include "../app/views/admin/layouts/master.php";
?>
