<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Lab AI Polinema</title>
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="css/styleLoginAdmin.css">
    <link rel="stylesheet" href="css/Style.css">
</head>
<body class="login-page">
    <!-- Floating Icons -->
    <i class="fas fa-lock floating-icon" style="font-size: 3rem;"></i>
    <i class="fas fa-user-shield floating-icon" style="font-size: 2.5rem;"></i>
    <i class="fas fa-key floating-icon" style="font-size: 3rem;"></i>
    <i class="fas fa-shield-alt floating-icon" style="font-size: 2.5rem;"></i>

    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <div class="login-logo">
                    <img src="img/logoAi.png" alt="Lab AI Logo">
                </div>
                <h1 class="login-title">Admin Login</h1>
                <p class="login-subtitle">Applied Informatics Laboratory</p>
            </div>
            <?php
                $error = isset($_GET['error']) ? $_GET['error'] : '';
            ?>
            <?php if ($error): ?>
                <div class="alert-box alert-error">
                    <i class="fas fa-exclamation-circle"></i>
                    <span><?= htmlspecialchars($error) ?></span>
                </div>
            <?php endif; ?>

            <form action="/admin/doLogin" method="POST" autocomplete="off" class="login-form">
                <div class="form-field">
                    <label for="username" class="field-label">
                        <i class="fas fa-user"></i> Username
                    </label>
                    <input 
                        type="text" 
                        name="username" 
                        id="username" 
                        class="field-input"
                        placeholder="Enter your username" 
                        required>
                </div>

                <div class="form-field">
                    <label for="password" class="field-label">
                        <i class="fas fa-lock"></i> Password
                    </label>
                    <div class="password-wrapper">
                        <input 
                            type="password" 
                            name="password" 
                            id="password" 
                            class="field-input"
                            placeholder="Enter your password" 
                            required>
                        <button type="button" class="toggle-password" onclick="togglePassword()">
                            <i class="fas fa-eye" id="toggleIcon"></i>
                        </button>
                    </div>
                </div>

                <button type="submit" class="login-btn">
                    <i class="fas fa-sign-in-alt"></i>
                    Sign In
                </button>
            </form>

            <div class="login-footer">
                <a href="index.php" class="back-link">
                    <i class="fas fa-arrow-left"></i> Back to Home
                </a>
            </div>
        </div>

        <div class="login-copyright">
            <p>© 2025 Applied Informatics Laboratory - Politeknik Negeri Malang. All Rights Reserved.</p>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordField = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');
            
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordField.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>
