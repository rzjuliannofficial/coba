<?php ob_start(); ?>

<h1 class="text-2xl font-bold mb-6">Edit PPM</h1>

<form action="/admin/Ppm/update/<?= $ppm['id'] ?>" method="POST"
      class="bg-white p-6 rounded-lg shadow w-full max-w-3xl">

    <label class="block font-semibold mb-1">Dosen</label>
    <select name="id" class="w-full p-2 border rounded mb-4">
        <?php foreach ($dosen as $d): ?>
            <option value="<?= $d['id'] ?>"
                <?= $ppm['id'] == $d['id'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($d['nama']) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label class="block font-semibold mb-1">Judul</label>
    <input type="text" name="judul"
           value="<?= htmlspecialchars($ppm['judul']) ?>"
           class="w-full p-2 border rounded mb-4">

    <label class="block font-semibold mb-1">Tahun</label>
    <input type="number" name="tahun"
           value="<?= htmlspecialchars($ppm['tahun']) ?>"
           class="w-full p-2 border rounded mb-4">

    <button class="bg-yellow-600 text-white px-4 py-2 rounded">Update</button>
</form>

<?php
$content = ob_get_clean();
include "../app/views/admin/layouts/master.php";
?>
