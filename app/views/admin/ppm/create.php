<?php ob_start(); ?>

<h1 class="text-2xl font-bold mb-6">Tambah PPM</h1>

<form action="/admin/Ppm/store" method="POST"
      class="bg-white p-6 rounded-lg shadow w-full max-w-3xl">

    <label class="block font-semibold mb-1">Dosen</label>
    <select name="id" class="w-full p-2 border rounded mb-4">
        <?php foreach ($dosen as $d): ?>
            <option value="<?= $d['id'] ?>"><?= htmlspecialchars($d['nama']) ?></option>
        <?php endforeach; ?>
    </select>

    <label class="block font-semibold mb-1">Judul</label>
    <input type="text" name="judul" class="w-full p-2 border rounded mb-4">

    <label class="block font-semibold mb-1">Tahun</label>
    <input type="number" name="tahun" class="w-full p-2 border rounded mb-4">

    <button class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
</form>

<?php
$content = ob_get_clean();
include "../app/views/admin/layouts/master.php";
?>
