<?php ob_start(); ?>

<h1 class="text-2xl font-bold mb-6">Tambah Produk</h1>

<form action="/admin/Produk/store" method="POST" enctype="multipart/form-data"
      class="bg-white p-6 rounded-lg shadow w-full max-w-3xl">

    <label class="block font-semibold mb-1">Nama Produk</label>
    <input type="text" name="nama_produk" class="w-full p-2 border rounded mb-4">

    <label class="block font-semibold mb-1">Deskripsi</label>
    <textarea name="deskripsi" class="w-full p-2 border rounded mb-4"></textarea>

    <label class="block font-semibold mb-1">Link Demo</label>
    <input type="text" name="link_demo" class="w-full p-2 border rounded mb-4">

    <label class="block font-semibold mb-1">Kategori</label>
    <input type="text" name="kategori" class="w-full p-2 border rounded mb-4">

    <label class="block font-semibold mb-1">Gambar Produk</label>
    <input type="file" name="image" class="w-full mb-4">

    <button class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>

</form>

<?php
$content = ob_get_clean();
include "../app/views/admin/layouts/master.php";
?>
