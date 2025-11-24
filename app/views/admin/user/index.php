<?php ob_start(); ?>

<h1 class="text-2xl font-bold mb-4">Daftar User</h1>

<a href="/admin/user/create" class="bg-blue-600 text-white px-4 py-2 rounded">Tambah User</a>

<table class="mt-6 w-full border border-gray-300 rounded-lg overflow-hidden">
    <tr class="bg-gray-100 font-semibold">
        <th class="p-3 border">ID</th>
        <th class="p-3 border">Username</th>
        <th class="p-3 border">Role</th>
        <th class="p-3 border text-center">Aksi</th>
    </tr>

    <?php while($row = pg_fetch_assoc($users)): ?>
    <tr class="hover:bg-gray-50">
        <td class="p-3 border"><?= $row['id'] ?></td>
        <td class="p-3 border"><?= $row['username'] ?></td>
        <td class="p-3 border capitalize"><?= $row['role'] ?></td>

        <td class="p-3 border text-center">

            <!-- Tombol Edit -->
            <a href="/admin/user/edit/<?= $row['id'] ?>" 
               class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-sm mr-2">
                <i class="fas fa-edit"></i> Edit
            </a>

            <!-- Tombol Hapus -->
            <a href="/admin/user/delete/<?= $row['id'] ?>" 
               onclick="return confirm('Hapus user ini?')" 
               class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-sm">
                <i class="fas fa-trash"></i> Hapus
            </a>

        </td>
    </tr>
    <?php endwhile; ?>
</table>

<?php 
$content = ob_get_clean();
include "../app/views/admin/layouts/master.php"; 
?>
