<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Siakad | Sistem Informasi Akademik</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="/css/styleLoginAdmin.css">
    <script src="jquery-ui-1.14.1/external/jquery/jquery.js"></script>
    <style>
        /* Gaya spesifik untuk error/success di dalam form box */
        .message-box {
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
            text-align: center;
            font-weight: bold;
        }
        .error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        .success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
    </style>
</head>
<body>
    <div class="container-main">
        <div class="container-right">
            <div class="head">
                <div class="head-left">
                    <h1>SIGN IN</h1>
                    <p>Admin</p>
                </div>
                <div class="head-right">
                    <img src="img/logo.png" alt="Logo">
                </div>
            </div>

<form action="/admin/doLogin" method="POST">

            <div class="login">

                <?php if (isset($_SESSION['error'])): ?>
                    <div class="error"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
                <?php endif; ?>

                <input type="text" name="username" placeholder="Username" required><br><br>

                <input type="password" name="password" placeholder="Password" required><br><br>

                <div class="submit">
                    <button type="submit">
                        Login
                        <i class="fas fa-arrow-right"></i>
                    </button>
                </div>

            </div>
        </form>

        <div class="Copyright">
            <p>© 2025 Sistem Informasi Akademik. All Rights Reserved.</p>
        </div>

    </div>
</div>

</body>
</html>