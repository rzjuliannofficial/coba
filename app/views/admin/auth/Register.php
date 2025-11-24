
<!DOCTYPE html>
<html>
<head>
    <title>Register User</title>
    <style>
        body { font-family: Arial; background: #f4f4f4; }
        .box {
            width: 400px; background: white; padding: 20px;
            margin: 80px auto; border-radius: 8px; box-shadow: 0 0 10px #ddd;
        }
        input, select, button { width: 100%; padding: 10px; margin-top: 10px; }
        .error { color: red; margin-top: 10px; }
        .success { color: green; margin-top: 10px; }
    </style>
</head>
<body>

<div class="box">
    <h2>Register User</h2>

    <?php if(isset($_SESSION['error'])): ?>
        <div class="error"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
    <?php endif; ?>

    <?php if(isset($_SESSION['success'])): ?>
        <div class="success"><?= $_SESSION['success']; unset($_SESSION['success']); ?></div>
    <?php endif; ?>

    <form action="/admin/auth/doRegister" method="post">
        <label>Username</label>
        <input type="text" name="username" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <label>Pilih Dosen</label>
        <select name="id_dosen" required>
    <option value="">-- Pilih Dosen --</option>
    <?php foreach($daftarDosen as $dosen): ?>
        <option value="<?= $dosen['id']; ?>"><?= $dosen['nama']; ?></option>
    <?php endforeach; ?>
</select>

        <button type="submit">Register</button>
    </form>

    <p style="margin-top:10px;">
        Sudah punya akun? <a href="/admin/login">Login</a>
    </p>
</div>

</body>
</html>
