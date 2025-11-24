<?php ob_start(); ?>

<h1 class="text-2xl font-bold mb-6">Edit Fasilitas</h1>

<form action="/admin/Fasilitas/update/<?= $fasilitas['id_fasilitas'] ?>" method="POST" enctype="multipart/form-data"
      class="bg-white p-6 rounded-lg shadow w-full max-w-3xl">

    <label class="block font-semibold mb-1">Nama Fasilitas</label>
    <input value="<?= htmlspecialchars($fasilitas['nama_fasilitas']) ?>" type="text" name="nama_fasilitas"
           class="w-full p-2 border rounded mb-4">

    <label class="block font-semibold mb-1">Deskripsi</label>
    <textarea name="deskripsi" class="w-full p-2 border rounded mb-4"><?= htmlspecialchars($fasilitas['deskripsi']) ?></textarea>

    <label class="block font-semibold mb-1">Kondisi</label>
    <select name="kondisi" class="w-full p-2 border rounded mb-4">
        <option value="baik" <?= $fasilitas['kondisi']=='baik'?'selected':'' ?>>Baik</option>
        <option value="rusak" <?= $fasilitas['kondisi']=='rusak'?'selected':'' ?>>Rusak</option>
        <option value="perbaikan" <?= $fasilitas['kondisi']=='perbaikan'?'selected':'' ?>>Dalam Perbaikan</option>
    </select>

    <label class="block font-semibold mb-1">Foto Baru (opsional)</label>
    <input type="file" name="foto" class="w-full mb-4">

    <?php if ($fasilitas['foto']): ?>
        <p class="font-semibold">Foto Saat Ini:</p>
        <img src="/uploads/fasilitas/<?= $fasilitas['foto'] ?>" class="w-32 h-32 rounded object-cover mb-4">
    <?php endif; ?>

    <button class="bg-yellow-600 text-white px-4 py-2 rounded">Update</button>

</form>

<?php
$content = ob_get_clean();
include "../app/views/admin/layouts/master.php";
?>
