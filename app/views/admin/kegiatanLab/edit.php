<?php ob_start(); ?>

<h1 class="text-2xl font-bold mb-6">Edit Kegiatan Lab</h1>

<form action="/admin/KegiatanLab/update/<?= $kegiatan['id'] ?>" method="POST"
      enctype="multipart/form-data"
      class="bg-white p-6 rounded-lg shadow w-full max-w-3xl">

    <label class="block font-semibold mb-1">Dosen</label>
    <select name="id_dosen" class="w-full p-2 border rounded mb-4">
        <?php foreach ($dosen as $d): ?>
            <option value="<?= $d['id'] ?>" <?= $kegiatan['id_dosen'] == $d['id'] ? 'selected':'' ?>>
                <?= htmlspecialchars($d['nama']) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label class="block font-semibold mb-1">Judul</label>
    <input type="text" name="judul" value="<?= htmlspecialchars($kegiatan['judul']) ?>"
           class="w-full p-2 border rounded mb-4">

    <label class="block font-semibold mb-1">Tanggal Kegiatan</label>
    <input type="date" name="tanggal_kegiatan"
           value="<?= htmlspecialchars($kegiatan['tanggal_kegiatan']) ?>"
           class="w-full p-2 border rounded mb-4">

    <label class="block font-semibold mb-1">Deskripsi</label>
    <textarea name="deskripsi" class="w-full p-2 border rounded mb-4"><?= htmlspecialchars($kegiatan['deskripsi']) ?></textarea>

    <label class="block font-semibold mb-1">Upload Dokumentasi Baru</label>
    <input type="file" name="file_dokumentasi" class="w-full mb-4">

    <?php if (!empty($kegiatan['file_dokumentasi'])): ?>
        <p class="text-sm">File saat ini:</p>
        <a href="/uploads/kegiatan_lab/<?= $kegiatan['file_dokumentasi'] ?>" target="_blank"
           class="text-blue-600 underline text-sm">
            Lihat File
        </a>
    <?php endif; ?>

    <button class="bg-yellow-600 text-white px-4 py-2 rounded mt-4">Update</button>
</form>

<?php
$content = ob_get_clean();
include "../app/views/admin/layouts/master.php";
?>
