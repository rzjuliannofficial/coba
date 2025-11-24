<?php ob_start(); ?>

<h1 class="text-2xl font-bold mb-6">Edit Produk</h1>

<form action="/admin/Produk/update/<?= $produk['id'] ?>" method="POST" enctype="multipart/form-data"
      class="bg-white p-6 rounded-lg shadow w-full max-w-3xl">

    <label class="block font-semibold mb-1">Nama Produk</label>
    <input type="text" name="nama_produk" value="<?= htmlspecialchars($produk['nama_produk']) ?>" class="w-full p-2 border rounded mb-4">

    <label class="block font-semibold mb-1">Deskripsi</label>
    <textarea name="deskripsi" class="w-full p-2 border rounded mb-4"><?= htmlspecialchars($produk['deskripsi']) ?></textarea>

    <label class="block font-semibold mb-1">Link Demo</label>
    <input type="text" name="link_demo" value="<?= htmlspecialchars($produk['link_demo']) ?>" class="w-full p-2 border rounded mb-4">

    <label class="block font-semibold mb-1">Kategori</label>
    <input type="text" name="kategori" value="<?= htmlspecialchars($produk['kategori']) ?>" class="w-full p-2 border rounded mb-4">

    <label class="block font-semibold mb-1">Gambar Baru (opsional)</label>
    <input type="file" name="image" class="w-full mb-4">

    <?php if ($produk['image']): ?>
        <p class="font-semibold">Gambar Saat Ini:</p>
        <img src="/uploads/produk/<?= $produk['image'] ?>" class="w-32 h-32 object-cover rounded mb-4">
    <?php endif; ?>

    <button class="bg-yellow-600 text-white px-4 py-2 rounded">Update</button>

</form>

<?php
$content = ob_get_clean();
include "../app/views/admin/layouts/master.php";
?>
