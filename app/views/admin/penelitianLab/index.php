<?php ob_start(); ?>

<h1 class="text-2xl font-bold mb-6">Penelitian Lab</h1>

<a href="/admin/PenelitianLab/create" class="bg-blue-600 text-white px-4 py-2 rounded">Tambah Penelitian</a>

<table class="mt-4 w-full border bg-white shadow">
    <thead class="bg-gray-100">
        <tr>
            <th class="p-2 border">Dosen</th>
            <th class="p-2 border">Judul</th>
            <th class="p-2 border">Status</th>
            <th class="p-2 border">Aksi</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($penelitian as $p): ?>
        <tr class="hover:bg-gray-50">
            <td class="p-2 border"><?= htmlspecialchars($p['nama_dosen']) ?></td>
            <td class="p-2 border"><?= htmlspecialchars($p['judul']) ?></td>
            <td class="p-2 border"><?= htmlspecialchars($p['status']) ?></td>

            <td class="p-2 border">
                <a href="/admin/PenelitianLab/edit/<?= $p['id'] ?>" class="text-yellow-600 mr-3">
                    <i class="fas fa-edit"></i> Edit
                </a>

                <a href="/admin/PenelitianLab/delete/<?= $p['id'] ?>"
                   onclick="return confirm('Hapus penelitian ini?')"
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
