<?php ob_start(); ?>

<h1 class="text-2xl font-bold mb-6">Daftar Publikasi Dosen</h1>

<a href="/admin/PublikasiDosen/create" class="bg-blue-600 text-white px-4 py-2 rounded">Tambah Publikasi</a>

<table class="mt-4 w-full border bg-white shadow">
    <thead class="bg-gray-100">
        <tr>
            <th class="p-2 border">Dosen</th>
            <th class="p-2 border">Judul</th>
            <th class="p-2 border">Deskripsi</th>
            <th class="p-2 border">Tahun</th>
            <th class="p-2 border">Kategori</th>
            <th class="p-2 border">Link</th>
            <th class="p-2 border">Aksi</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($publikasi as $p): ?>
            <tr class="hover:bg-gray-50">
                <td class="p-2 border"><?= htmlspecialchars($p['nama_dosen']) ?></td>
                <td class="p-2 border"><?= htmlspecialchars($p['judul']) ?></td>
                <td class="p-2 border"><?= htmlspecialchars($p['deskripsi']) ?></td>
                <td class="p-2 border"><?= htmlspecialchars($p['tahun']) ?></td>
                <td class="p-2 border"><?= htmlspecialchars($p['kategori']) ?></td>
                <td class="p-2 border">
                    <a href="<?= htmlspecialchars($p['link_jurnal']) ?>" 
                       target="_blank" 
                       class="text-blue-600 underline">Lihat</a>
                </td>
                <td class="p-2 border">
                    <a href="/admin/PublikasiDosen/edit/<?= $p['id'] ?>" class="text-yellow-600 mr-3">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <a href="/admin/PublikasiDosen/delete/<?= $p['id'] ?>"
                       onclick="return confirm('Hapus publikasi ini?')" 
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
