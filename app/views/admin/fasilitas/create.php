
<?php ob_start(); ?>

<h1 class="text-2xl font-bold mb-6">Tambah Fasilitas</h1>

<form action="/admin/Fasilitas/store" method="POST" enctype="multipart/form-data"
      class="bg-white p-6 rounded-lg shadow w-full max-w-3xl">

    <label class="block font-semibold mb-1">Nama Fasilitas</label>
    <input type="text" name="nama_fasilitas" class="w-full p-2 border rounded mb-4">

    <label class="block font-semibold mb-1">Deskripsi</label>
    <textarea name="deskripsi" class="w-full p-2 border rounded mb-4"></textarea>

    <label class="block font-semibold mb-1">Kondisi</label>
    <select name="kondisi" class="w-full p-2 border rounded mb-4">
        <option value="baik">Baik</option>
        <option value="rusak">Rusak</option>
        <option value="perbaikan">Dalam Perbaikan</option>
    </select>

    <label class="block font-semibold mb-1">Foto</label>
    <input type="file" name="foto" class="w-full mb-4">

    <button class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>

</form>

<?php
$content = ob_get_clean();
include "../app/views/admin/layouts/master.php";
?>
