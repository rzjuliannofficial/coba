<?php ob_start(); ?>

<h1 class="text-2xl font-bold mb-6">Riset Dosen</h1>

<a href="/admin/RisetDosen/create" class="bg-blue-600 text-white px-4 py-2 rounded">Tambah Riset</a>

<table class="mt-4 w-full border bg-white shadow">
    <thead class="bg-gray-100">
        <tr>
            <th class="p-2 border">Dosen</th>
            <th class="p-2 border">Judul</th>
            <th class="p-2 border">Tahun</th>
            <th class="p-2 border">Sumber Dana</th>
            <th class="p-2 border">Aksi</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($riset as $r): ?>
        <tr class="hover:bg-gray-50">
            <td class="p-2 border"><?= htmlspecialchars($r['nama_dosen']) ?></td>
            <td class="p-2 border"><?= htmlspecialchars($r['judul']) ?></td>
            <td class="p-2 border"><?= htmlspecialchars($r['tahun']) ?></td>
            <td class="p-2 border"><?= htmlspecialchars($r['sumber_dana']) ?></td>

            <td class="p-2 border">
                <a href="/admin/RisetDosen/edit/<?= $r['id'] ?>" class="text-yellow-600 mr-3">
                    <i class="fas fa-edit"></i> Edit
                </a>

                <a href="/admin/RisetDosen/delete/<?= $r['id'] ?>"
                   onclick="return confirm('Hapus riset ini?')"
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
