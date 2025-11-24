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
    <title><?= $title ?? 'Website Saya' ?></title>
    <link rel="stylesheet" href="/assets/style.css">
</head>

<body>

    <?php include __DIR__ . '/navbar.php'; ?>

    <main>
        <?= $content ?>
    </main>

    <?php include __DIR__ . '/footer.php'; ?>

</body>

</html>