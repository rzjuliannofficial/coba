<?php ob_start(); ?>

<h1 class="text-2xl font-bold mb-6">Edit Riset Dosen</h1>

<form action="/admin/RisetDosen/update/<?= $riset['id'] ?>" method="POST"
      class="bg-white p-6 rounded-lg shadow w-full max-w-3xl">

    <label class="block font-semibold mb-1">Dosen</label>
    <select name="id_dosen" class="w-full p-2 border rounded mb-4">
        <?php foreach ($dosen as $d): ?>
            <option value="<?= $d['id'] ?>"
                <?= $riset['id_dosen'] == $d['id'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($d['nama']) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label class="block font-semibold mb-1">Judul Riset</label>
    <input type="text" name="judul"
           value="<?= htmlspecialchars($riset['judul']) ?>"
           class="w-full p-2 border rounded mb-4">

    <label class="block font-semibold mb-1">Tahun</label>
    <input type="number" name="tahun"
           value="<?= htmlspecialchars($riset['tahun']) ?>"
           class="w-full p-2 border rounded mb-4">

    <label class="block font-semibold mb-1">Sumber Dana</label>
    <input type="text" name="sumber_dana"
           value="<?= htmlspecialchars($riset['sumber_dana']) ?>"
           class="w-full p-2 border rounded mb-4">

    <button class="bg-yellow-600 text-white px-4 py-2 rounded">Update</button>
</form>

<?php
$content = ob_get_clean();
include "../app/views/admin/layouts/master.php";
?>
