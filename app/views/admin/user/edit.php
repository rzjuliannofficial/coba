<?php ob_start(); ?>

<h1 class="text-2xl font-bold mb-6">Edit User</h1>

<?php if(isset($_SESSION['error'])): ?>
    <div class="bg-red-100 text-red-700 p-3 rounded mb-4 border border-red-300">
        <?= $_SESSION['error']; unset($_SESSION['error']); ?>
    </div>
<?php endif; ?>

<!-- Center Box -->
<div class="flex justify-center mt-6">

    <form action="/admin/user/update/<?= $user['id'] ?>" method="POST"
          class="bg-white p-6 rounded-xl shadow-lg w-3/4 max-w-4xl border border-gray-200">

        <!-- Username -->
        <label class="block mb-1 font-semibold">Username</label>
        <input type="text" name="username" value="<?= $user['username'] ?>" required
               class="w-full p-2 border rounded mb-4 focus:ring focus:ring-blue-300">

        <!-- Password -->
        <label class="block mb-1 font-semibold">Password (biarkan kosong jika tidak ingin mengubah)</label>
        <input type="password" name="password"
               class="w-full p-2 border rounded mb-4 focus:ring focus:ring-blue-300">

        <!-- Role -->
        <label class="block mb-1 font-semibold">Role</label>
        <select name="role"
                class="w-full p-2 border rounded mb-4 focus:ring focus:ring-blue-300">
            <option value="admin" <?= $user['role']=='admin' ? 'selected' : '' ?>>Admin</option>
            <option value="editor" <?= $user['role']=='editor' ? 'selected' : '' ?>>Editor</option>
        </select>

        <label class="block mb-1 font-semibold">Dosen (hanya untuk editor)</label>
        <select name="id_dosen" class="w-full p-2 border rounded mb-4 focus:ring focus:ring-blue-300">
            <option value="">-- Pilih Dosen --</option>
            <?php foreach($dosens as $d): ?>
                <option value="<?= $d['id'] ?>" <?= ($user['id_dosen'] ?? '') == $d['id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($d['nama']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <!-- Button -->
        <button class="bg-yellow-600 hover:bg-yellow-700 text-white px-4 py-2 rounded w-full font-semibold">
            Update
        </button>

    </form>

</div>



<?php 
$content = ob_get_clean();
include "../app/views/admin/layouts/master.php";
?>
