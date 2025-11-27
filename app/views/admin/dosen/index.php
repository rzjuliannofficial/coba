<?php ob_start(); ?>

<h1 class="text-2xl font-bold mb-6">Daftar Dosen</h1>

<a href="/admin/dosen/create" class="bg-blue-600 text-white px-4 py-2 rounded">Tambah Dosen</a>

<table class="mt-4 w-full border bg-white shadow">
    <thead class="bg-gray-100">
        <tr>
            <th class="p-2 border">Foto</th>
            <th class="p-2 border">Nama</th>
            <th class="p-2 border">NIP</th>
            <th class="p-2 border">Email</th>
            <th class="p-2 border">Keahlian</th>
            <th class="p-2 border">Deskripsi</th>
            <th class="p-2 border">Jabatan</th>
            <th class="p-2 border">Aksi</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($dosen as $d): ?>
        <tr class="hover:bg-gray-50">
            <td class="p-2 border">
                <?php if (!empty($d['foto_profil'])): ?>
                    <img src="/uploads/dosen/<?= htmlspecialchars($d['foto_profil']) ?>" class="w-12 h-12 rounded-full object-cover">
                <?php else: ?>
                    <div class="w-12 h-12 rounded-full bg-gray-200 flex items-center justify-center text-xs text-gray-500">No</div>
                <?php endif; ?>
            </td>
            <td class="p-2 border"><?= htmlspecialchars($d['nama']) ?></td>
            <td class="p-2 border"><?= htmlspecialchars($d['nip']) ?></td>
            <td class="p-2 border"><?= htmlspecialchars($d['email']) ?></td>
            <td class="p-2 border"><?= htmlspecialchars($d['keahlian_text']) ?></td>
            <td class="p-2 border"><?= htmlspecialchars($d['deskripsi']) ?></td>
            <td class="p-2 border"><?= htmlspecialchars($d['jabatan']) ?></td>
            <td class="p-2 border">
                <a href="/admin/dosen/edit/<?= $d['id'] ?>" class="text-yellow-600 mr-2"><i class="fas fa-edit"></i> Edit</a>
                <a href="/admin/dosen/delete/<?= $d['id'] ?>" onclick="return confirm('Hapus dosen ini?')" class="text-red-600"><i class="fas fa-trash"></i> Hapus</a>
            </td>
        </tr>
   <?php endforeach; ?>
    </tbody>
</table>

<?php 
$content = ob_get_clean();
include "../app/views/admin/layouts/master.php";
?>
