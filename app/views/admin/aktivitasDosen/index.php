<?php ob_start(); ?>

<h1 class="text-2xl font-bold mb-6">Aktivitas Dosen</h1>

<a href="/admin/AktivitasDosen/create" class="bg-blue-600 text-white px-4 py-2 rounded">Tambah Aktivitas</a>

<table class="mt-4 w-full border bg-white shadow">
    <thead class="bg-gray-100">
        <tr>
            <th class="p-2 border">Dosen</th>
            <th class="p-2 border">Judul</th>
            <th class="p-2 border">Jenis</th>
            <th class="p-2 border">Tanggal</th>
            <th class="p-2 border">Deskripsi</th>
            <th class="p-2 border">Aksi</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($aktivitas as $a): ?>
        <tr class="hover:bg-gray-50">
            <td class="p-2 border"><?= htmlspecialchars($a['nama_dosen']) ?></td>
            <td class="p-2 border"><?= htmlspecialchars($a['judul']) ?></td>
            <td class="p-2 border"><?= htmlspecialchars($a['jenis_aktivitas']) ?></td>
            <td class="p-2 border"><?= htmlspecialchars($a['tanggal']) ?></td>
            <td class="p-2 border"><?= htmlspecialchars($a['deskripsi']) ?></td>

            <td class="p-2 border">
                <a href="/admin/AktivitasDosen/edit/<?= $a['id'] ?>" class="text-yellow-600 mr-3">
                    <i class="fas fa-edit"></i> Edit
                </a>
                <a href="/admin/AktivitasDosen/delete/<?= $a['id'] ?>"
                   onclick="return confirm('Hapus aktivitas ini?')"
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
