<?php ob_start(); ?>

<h1 class="text-2xl font-bold mb-6">Edit Caption Galeri</h1>

<?php
$fileUrl = "/uploads/" . $item['file_url'];
?>

<div class="bg-white p-6 rounded-lg shadow w-full max-w-3xl">

    <div class="mb-4">
        <p class="font-semibold mb-2">Preview Gambar</p>
        <a href="<?= $fileUrl ?>" target="_blank">
            <img src="<?= $fileUrl ?>" class="w-48 h-48 object-cover rounded border">
        </a>
    </div>

    <form action="/admin/galeri/update/<?= $item['id'] ?>" method="POST">

        <label class="block font-semibold mb-1">Caption</label>
        <textarea name="caption"
                  class="w-full p-2 border rounded mb-4"
                  rows="3"><?= htmlspecialchars($item['caption'] ?? '') ?></textarea>

        <button class="bg-yellow-600 text-white px-4 py-2 rounded">
            Simpan Caption
        </button>

        <a href="/admin/galeri" class="ml-2 text-gray-600 text-sm">Kembali</a>
    </form>

</div>

<?php
$content = ob_get_clean();
include "../app/views/admin/layouts/master.php";
?>
