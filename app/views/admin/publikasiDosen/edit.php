<?php ob_start(); ?>

<h1 class="text-2xl font-bold mb-6">Edit Publikasi Dosen</h1>

<form action="/admin/PublikasiDosen/update/<?= $publikasi['id'] ?>" method="POST"
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
    <input type="text" name="judul"
           value="<?= htmlspecialchars($publikasi['judul']) ?>"
           class="w-full p-2 border rounded mb-4">

    <label class="block font-semibold mb-1">Deskripsi</label>
    <textarea name="deskripsi" class="w-full p-2 border rounded mb-4"><?= htmlspecialchars($publikasi['deskripsi']) ?></textarea>

    <label class="block font-semibold mb-1">Tahun</label>
    <input type="number" name="tahun"
           value="<?= htmlspecialchars($publikasi['tahun']) ?>"
           class="w-full p-2 border rounded mb-4">

    <label class="block font-semibold mb-1">Kategori</label>
    <input type="text" name="kategori"
           value="<?= htmlspecialchars($publikasi['kategori']) ?>"
           class="w-full p-2 border rounded mb-4">

    <label class="block font-semibold mb-1">Link Jurnal</label>
    <input type="text" name="link_jurnal"
           value="<?= htmlspecialchars($publikasi['link_jurnal']) ?>"
           class="w-full p-2 border rounded mb-4">

    <button class="bg-yellow-600 text-white px-4 py-2 rounded">Update</button>

</form>

<?php 
$content = ob_get_clean();
include "../app/views/admin/layouts/master.php";
?>
