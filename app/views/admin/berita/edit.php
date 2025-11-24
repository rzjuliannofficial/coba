<?php ob_start(); ?>

<h1 class="text-2xl font-bold mb-6">Edit Berita</h1>

<form action="/admin/Berita/update/<?= $berita['id'] ?>" method="POST" enctype="multipart/form-data"
      class="bg-white p-6 rounded-lg shadow w-full max-w-3xl">

    <label class="block font-semibold mb-1">Judul</label>
    <input type="text" name="judul" value="<?= htmlspecialchars($berita['judul']) ?>" class="w-full p-2 border rounded mb-4">

    <label class="block font-semibold mb-1">Isi Berita</label>
    <textarea name="isi_berita" class="w-full p-2 border rounded mb-4"><?= htmlspecialchars($berita['isi_berita']) ?></textarea>

    <label class="block font-semibold mb-1">Tanggal</label>
    <input type="date" name="tanggal" value="<?= $berita['tanggal'] ?>" class="w-full p-2 border rounded mb-4">

    <label class="block font-semibold mb-1">Gambar Baru (Opsional)</label>
    <input type="file" name="gambar_utama" class="w-full mb-4">

    <?php if ($berita['gambar_utama']): ?>
        <p class="font-semibold mb-1">Gambar Saat Ini:</p>
        <img src="/uploads/berita/<?= $berita['gambar_utama'] ?>" class="w-32 h-32 object-cover rounded mb-4">
    <?php endif; ?>

    <button class="bg-yellow-600 text-white px-4 py-2 rounded">Update</button>

</form>

<?php
$content = ob_get_clean();
include "../app/views/admin/layouts/master.php";
?>
