<?php ob_start(); ?>

<h1 class="text-2xl font-bold mb-6">Produk</h1>

<a href="/admin/Produk/create" class="bg-blue-600 text-white px-4 py-2 rounded">Tambah Produk</a>

<table class="mt-4 w-full border bg-white shadow">
    <thead class="bg-gray-100">
        <tr>
            <th class="p-2 border">Gambar</th>
            <th class="p-2 border">Nama Produk</th>
            <th class="p-2 border">Kategori</th>
            <th class="p-2 border">Aksi</th>
        </tr>
    </thead>

    <tbody>
    <?php foreach ($produk as $p): ?>
        <tr class="hover:bg-gray-50">

            <td class="p-2 border">
                <?php if ($p['image']): ?>
                    <img src="/uploads/produk/<?= $p['image'] ?>" class="w-16 h-16 rounded object-cover">
                <?php else: ?>
                    <span class="text-gray-400 text-sm">-</span>
                <?php endif; ?>
            </td>

            <td class="p-2 border"><?= htmlspecialchars($p['nama_produk']) ?></td>
            <td class="p-2 border"><?= htmlspecialchars($p['kategori']) ?></td>

            <td class="p-2 border">
                <a href="/admin/Produk/edit/<?= $p['id'] ?>" class="text-yellow-600 mr-2"><i class="fas fa-edit"></i> Edit</a>
                <a href="/admin/Produk/delete/<?= $p['id'] ?>" onclick="return confirm('Hapus produk ini?')" class="text-red-600">
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
