<!-- layout/main.php -->
<?php
if (!isset($content)) {
    $content = '';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data['judul']?></title>
    <link rel="stylesheet" href="<?= BASE_URL ?>public/css/Style.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>

<body>

    <?php include __DIR__ . '/navbar.php'; ?>

    <main>
        <?= $content ?>
    </main>

    <?php include __DIR__ . '/footer.php'; ?>
    <div class="bottom-blur-overlay"></div>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="script.js"></script>
</html>