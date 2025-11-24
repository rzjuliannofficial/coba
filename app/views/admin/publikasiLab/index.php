<?php ob_start(); ?>

<h1 class="text-2xl font-bold mb-6">Publikasi Lab</h1>

<a href="/admin/PublikasiLab/create" class="bg-blue-600 text-white px-4 py-2 rounded">Tambah Publikasi Lab</a>

<table class="mt-4 w-full border bg-white shadow">
    <thead class="bg-gray-100">
        <tr>
            <th class="p-2 border">Dosen</th>
            <th class="p-2 border">Judul</th>
            <th class="p-2 border">Kategori</th>
            <th class="p-2 border">Dokumen</th>
            <th class="p-2 border">Aksi</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($publikasi as $p): ?>
        <tr class="hover:bg-gray-50">
            <td class="p-2 border"><?= htmlspecialchars($p['nama_dosen']) ?></td>
            <td class="p-2 border"><?= htmlspecialchars($p['judul']) ?></td>
            <td class="p-2 border"><?= htmlspecialchars($p['kategori']) ?></td>
            <td class="p-2 border">
                <?php if (!empty($p['file_dokumen'])): ?>
                    <a href="/uploads/publikasi_lab/<?= $p['file_dokumen'] ?>" target="_blank" class="text-blue-600 underline">Lihat Dokumen</a>
                <?php else: ?>
                    <span class="text-gray-500 text-sm">Tidak ada</span>
                <?php endif; ?>
            </td>

            <td class="p-2 border">
                <a href="/admin/PublikasiLab/edit/<?= $p['id'] ?>" class="text-yellow-600 mr-3"><i class="fas fa-edit"></i> Edit</a>
                <a href="/admin/PublikasiLab/delete/<?= $p['id'] ?>"
                   onclick="return confirm('Hapus publikasi ini?')" 
                   class="text-red-600"><i class="fas fa-trash"></i> Hapus</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php
$content = ob_get_clean();
include "../app/views/admin/layouts/master.php";
?>
