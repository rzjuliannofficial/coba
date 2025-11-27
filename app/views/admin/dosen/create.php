<?php ob_start(); ?>

<h1 class="text-2xl font-bold mb-6">Tambah Dosen</h1>

<form action="/admin/dosen/store" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow w-full max-w-3xl">
    <label class="block font-semibold mb-1">Nama</label>
    <input type="text" name="nama" required class="w-full p-2 border rounded mb-4">

    <label class="block font-semibold mb-1">NIP</label>
    <input type="text" name="nip" required class="w-full p-2 border rounded mb-4">

    <label class="block font-semibold mb-1">Email</label>
    <input type="email" name="email" required class="w-full p-2 border rounded mb-4">

        <label class="block font-semibold mb-1">Keahlian</label>
    <input type="keahlian_text" name="keahlian_text" required class="w-full p-2 border rounded mb-4">

        <label class="block font-semibold mb-1">Deskripsi</label>
    <input type="deskripsi" name="deskripsi" required class="w-full p-2 border rounded mb-4">

        <label class="block font-semibold mb-1">Jabatan</label>
    <select name="jabatan" class="w-full p-2 border rounded mb-4">
        <option value="ketua_lab">ketua lab</option>
        <option value="asisten_lab">asisten lab</option>
        <option value="member">member</option>
    </select>

    <label class="block font-semibold mb-1">Foto Profil (opsional)</label>
    <input type="file" name="foto" class="w-full mb-4">

    <button class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
</form>

<?php 
$content = ob_get_clean();
include "../app/views/admin/layouts/master.php";
?>
