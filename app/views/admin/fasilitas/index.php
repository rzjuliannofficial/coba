<?php ob_start(); ?>

<h1 class="text-2xl font-bold mb-6">Fasilitas</h1>

<a href="/admin/Fasilitas/create" class="bg-blue-600 text-white px-4 py-2 rounded">Tambah Fasilitas</a>

<table class="mt-4 w-full border bg-white shadow">
    <thead class="bg-gray-100">
        <tr>
            <th class="p-2 border">Foto</th>
            <th class="p-2 border">Nama</th>
            <th class="p-2 border">Kondisi</th>
            <th class="p-2 border">Aksi</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($fasilitas as $f): ?>
        <tr class="hover:bg-gray-50">

            <td class="p-2 border">
                <?php if ($f['foto']): ?>
                    <img src="/uploads/fasilitas/<?= $f['foto'] ?>"class="w-16 h-16 rounded object-cover">
                <?php else: ?>
                    <span class="text-gray-400 text-sm">-</span>
                <?php endif; ?>
            </td>

            <td class="p-2 border"><?= htmlspecialchars($f['nama_fasilitas']) ?></td>
            <td class="p-2 border"><?= htmlspecialchars($f['kondisi']) ?></td>

            <td class="p-2 border">
                <a href="/admin/Fasilitas/edit/<?= $f['id_fasilitas'] ?>" class="text-yellow-600 mr-2">
                    <i class="fas fa-edit"></i> Edit
                </a>

                <a href="/admin/Fasilitas/delete/<?= $f['id_fasilitas'] ?>"
                    onclick="return confirm('Hapus fasilitas ini?')"
                    class="text-red-600">
                    <i class="fas fa-trash"></i> Hapus
                </a>
            </td>

        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php
$content = ob_get_clean();
include "../app/views/admin/layouts/master.php";
?>
