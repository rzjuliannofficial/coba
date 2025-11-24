<?php ob_start(); ?>

<h1 class="text-2xl font-bold mb-6">Berita</h1>

<a href="/admin/Berita/create" class="bg-blue-600 text-white px-4 py-2 rounded">Tambah Berita</a>

<table class="mt-4 w-full border bg-white shadow">
    <thead class="bg-gray-100">
        <tr>
            <th class="p-2 border">Judul</th>
            <th class="p-2 border">Isi</th>
            <th class="p-2 border">Tanggal</th>
            <th class="p-2 border">Gambar</th>
            <th class="p-2 border">Aksi</th>
        </tr>
    </thead>

    <tbody>
    <?php foreach ($berita as $b): ?>
        <tr class="hover:bg-gray-50">
            <td class="p-2 border"><?= htmlspecialchars($b['judul']) ?></td>
            <td class="p-2 border"><?= htmlspecialchars($b['isi_berita']) ?></td>
            <td class="p-2 border"><?= htmlspecialchars($b['tanggal']) ?></td>

            <td class="p-2 border">
                <?php if ($b['gambar_utama']): ?>
                    <img src="/uploads/berita/<?= $b['gambar_utama'] ?>" class="w-16 h-16 object-cover rounded">
                <?php else: ?>
                    <span class="text-gray-400">-</span>
                <?php endif; ?>
            </td>

            <td class="p-2 border">
                <a href="/admin/Berita/edit/<?= $b['id'] ?>" class="text-yellow-600 mr-2">
                    <i class="fas fa-edit"></i> Edit
                </a>

                <a href="/admin/Berita/delete/<?= $b['id'] ?>" 
                   onclick="return confirm('Hapus berita ini?')"
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
