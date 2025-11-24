<?php ob_start(); ?>

<h1 class="text-2xl font-bold mb-6">Edit Dosen</h1>

<form action="/admin/dosen/update/<?= $dosen['id'] ?>" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow w-full max-w-3xl">
    <label class="block font-semibold mb-1">Nama</label>
    <input type="text" name="nama" required value="<?= htmlspecialchars($dosen['nama']) ?>" class="w-full p-2 border rounded mb-4">

    <label class="block font-semibold mb-1">NIP</label>
    <input type="text" name="nip" required value="<?= htmlspecialchars($dosen['nip']) ?>" class="w-full p-2 border rounded mb-4">

    <label class="block font-semibold mb-1">Email</label>
    <input type="email" name="email" required value="<?= htmlspecialchars($dosen['email']) ?>" class="w-full p-2 border rounded mb-4">

    <label class="block font-semibold mb-1">Foto Profil Baru (opsional)</label>
    <input type="file" name="foto" class="w-full mb-4">

    <?php if (!empty($dosen['foto_profil'])): ?>
        <p class="mb-2 font-semibold">Foto Saat Ini:</p>
        <img src="/uploads/dosen/<?= htmlspecialchars($dosen['foto_profil']) ?>" class="w-24 h-24 rounded-full mb-4 object-cover">
    <?php endif; ?>

    <button class="bg-yellow-600 text-white px-4 py-2 rounded">Update</button>
</form>

<?php 
$content = ob_get_clean();
include "../app/views/admin/layouts/master.php";
?>
