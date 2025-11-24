<?php ob_start(); ?>

<h1 class="text-2xl font-bold mb-6">Kegiatan Lab</h1>

<a href="/admin/KegiatanLab/create" class="bg-blue-600 text-white px-4 py-2 rounded">Tambah Kegiatan</a>

<table class="mt-4 w-full border bg-white shadow">
    <thead class="bg-gray-100">
        <tr>
            <th class="p-2 border">Dosen</th>
            <th class="p-2 border">Judul</th>
            <th class="p-2 border">Tanggal</th>
            <th class="p-2 border">Dokumentasi</th>
            <th class="p-2 border">Aksi</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($kegiatan as $k): ?>
        <tr class="hover:bg-gray-50">
            <td class="p-2 border"><?= htmlspecialchars($k['nama_dosen']) ?></td>
            <td class="p-2 border"><?= htmlspecialchars($k['judul']) ?></td>
            <td class="p-2 border"><?= htmlspecialchars($k['tanggal_kegiatan']) ?></td>

            <td class="p-2 border">
                <?php if (!empty($k['file_dokumentasi'])): ?>
                    <a href="/uploads/kegiatan_lab/<?= $k['file_dokumentasi'] ?>" target="_blank" class="text-blue-600 underline">
                        Lihat File
                    </a>
                <?php else: ?>
                    <span class="text-gray-500">Tidak ada</span>
                <?php endif; ?>
            </td>

            <td class="p-2 border">
                <a href="/admin/KegiatanLab/edit/<?= $k['id'] ?>" class="text-yellow-600 mr-3"><i class="fas fa-edit"></i> Edit</a>
                <a href="/admin/KegiatanLab/delete/<?= $k['id'] ?>"
                   onclick="return confirm('Hapus kegiatan ini?')" 
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
