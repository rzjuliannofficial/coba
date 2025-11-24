<?php ob_start(); ?>

<h1 class="text-2xl font-bold mb-6">Tambah Berita</h1>

<form action="/admin/Berita/store" method="POST" enctype="multipart/form-data"
      class="bg-white p-6 rounded-lg shadow w-full max-w-3xl">

    <label class="block font-semibold mb-1">Judul</label>
    <input type="text" name="judul" class="w-full p-2 border rounded mb-4">

    <label class="block font-semibold mb-1">Isi Berita</label>
    <textarea name="isi_berita" class="w-full p-2 border rounded mb-4"></textarea>

    <label class="block font-semibold mb-1">Tanggal</label>
    <input type="date" name="tanggal" class="w-full p-2 border rounded mb-4">

    <label class="block font-semibold mb-1">Gambar Utama</label>
    <input type="file" name="gambar_utama" class="w-full mb-4">

    <button class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>

</form>

<?php
$content = ob_get_clean();
include "../app/views/admin/layouts/master.php";
?>
