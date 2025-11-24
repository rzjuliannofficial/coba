<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Admin Panel'; ?></title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
</head>

<body class="bg-gray-100">

    <!-- Sidebar -->
    <?php include __DIR__ . "/sidebar.php"; ?>

    <!-- Header -->
    <?php include __DIR__ . "/header.php"; ?>

    <!-- Content -->
    <main class="ml-64 mt-20 p-6">
        <?= $content; ?>
    </main>

    <!-- Footer -->
    <footer class="ml-64 p-4 text-center text-gray-600 text-sm">
        © 2025 Lab AI — Dashboard v1.0
    </footer>

</body>
</html>
