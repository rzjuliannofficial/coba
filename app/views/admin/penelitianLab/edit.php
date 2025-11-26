<?php ob_start(); ?>

<h1 class="text-2xl font-bold mb-6">Edit Penelitian Lab</h1>

<form action="/admin/PenelitianLab/update/<?= $penelitian['id'] ?>" method="POST"
      class="bg-white p-6 rounded-lg shadow w-full max-w-3xl">

    <label class="block font-semibold mb-1">Dosen</label>
    <select name="id" class="w-full p-2 border rounded mb-4">
        <?php foreach ($dosen as $d): ?>
            <option value="<?= $d['id'] ?>"
                <?= $penelitian['id'] == $d['id'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($d['nama']) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label class="block font-semibold mb-1">Judul</label>
    <input type="text" name="judul"
           value="<?= htmlspecialchars($penelitian['judul']) ?>"
           class="w-full p-2 border rounded mb-4">

    <label class="block font-semibold mb-1">Deskripsi</label>
    <textarea name="deskripsi" class="w-full p-2 border rounded mb-4"><?= htmlspecialchars($penelitian['deskripsi']) ?></textarea>

    <label class="block font-semibold mb-1">Status</label>
    <select name="status" class="w-full p-2 border rounded mb-4">
        <option value="berjalan" <?= $penelitian['status']=='berjalan'?'selected':'' ?>>Berjalan</option>
        <option value="selesai" <?= $penelitian['status']=='selesai'?'selected':'' ?>>Selesai</option>
        <option value="rencana" <?= $penelitian['status']=='rencana'?'selected':'' ?>>Rencana</option>
    </select>

    <button class="bg-yellow-600 text-white px-4 py-2 rounded">Update</button>
</form>

<?php
$content = ob_get_clean();
include "../app/views/admin/layouts/master.php";
?>
