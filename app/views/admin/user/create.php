<?php ob_start(); ?>

<h1 class="text-2xl font-bold mb-6">Tambah User</h1>

<?php if(isset($_SESSION['error'])): ?>
    <div class="bg-red-100 text-red-700 p-3 rounded mb-4 border border-red-300">
        <?= $_SESSION['error']; unset($_SESSION['error']); ?>
    </div>
<?php endif; ?>

<!-- Center Box -->
<div class="flex justify-center mt-6">

    <form action="/admin/user/store" method="POST" 
        class="bg-white p-6 rounded-xl shadow-lg w-3/4 max-w-4xl border border-gray-200">

        <label class="block mb-1 font-semibold">Username</label>
        <input type="text" name="username" required
               class="w-full p-2 border rounded mb-4 focus:ring focus:ring-blue-300">

        <label class="block mb-1 font-semibold">Password</label>
        <input type="password" name="password" required
               class="w-full p-2 border rounded mb-4 focus:ring focus:ring-blue-300">

        <label class="block mb-1 font-semibold">Role</label>
        <select name="role"
                class="w-full p-2 border rounded mb-4 focus:ring focus:ring-blue-300">
            <option value="admin">Admin</option>
            <option value="editor">Editor</option>
        </select>

        <label>Pilih Dosen</label>
<select name="id_dosen" required>
    <option value="">-- Pilih Dosen --</option>
    <?php foreach($dosen as $d): ?>
        <option value="<?= $d['id'] ?>"><?= htmlspecialchars($d['nama']) ?></option>
    <?php endforeach; ?>
</select>


        <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded w-full font-semibold">
            Simpan
        </button>
    </form>

</div>

<?php 
$content = ob_get_clean();
include "../app/views/admin/layouts/master.php";
?>
