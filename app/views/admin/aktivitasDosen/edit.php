<?php ob_start(); ?>

<h1 class="text-2xl font-bold mb-6">Edit Aktivitas Dosen</h1>

<form action="/admin/AktivitasDosen/update/<?= $aktivitas['id'] ?>" method="POST"
      class="bg-white p-6 rounded-lg shadow w-full max-w-3xl">

    <label class="block font-semibold mb-1">Dosen</label>
    <select name="id_dosen" class="w-full p-2 border rounded mb-4">
        <?php foreach ($dosen as $d): ?>
            <option value="<?= $d['id'] ?>"
                <?= $d['id'] == $aktivitas['id_dosen'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($d['nama']) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label class="block font-semibold mb-1">Judul</label>
    <input type="text" name="judul"
           value="<?= htmlspecialchars($aktivitas['judul']) ?>"
           class="w-full p-2 border rounded mb-4">

    <label class="block font-semibold mb-1">Jenis Aktivitas</label>
    <input type="text" name="jenis_aktivitas"
           value="<?= htmlspecialchars($aktivitas['jenis_aktivitas']) ?>"
           class="w-full p-2 border rounded mb-4">

    <label class="block font-semibold mb-1">Tanggal</label>
    <input type="date" name="tanggal"
           value="<?= htmlspecialchars($aktivitas['tanggal']) ?>"
           class="w-full p-2 border rounded mb-4">

    <label class="block font-semibold mb-1">Deskripsi</label>
    <textarea name="deskripsi"
              class="w-full p-2 border rounded mb-4"><?= htmlspecialchars($aktivitas['deskripsi']) ?></textarea>

    <button class="bg-yellow-600 text-white px-4 py-2 rounded">Update</button>
</form>

<?php
$content = ob_get_clean();
include "../app/views/admin/layouts/master.php";
?>
