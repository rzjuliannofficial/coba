<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data['title']?></title>
    <link rel="stylesheet" href="/css/Style.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>

<body>
    <header class="sticky-header">
        <nav class="header-nav">
            <a href="index.php">
                <div class="logo-area">
                    <div class="logo-image-container">
                        <img src="img/logoAi.png" alt="Lab AI Logo">
                    </div>
                    <div class="logo-text">
                        Applied <br>Informatics
                    </div>
                </div>
            </a>
            
            <div class="nav-links">
                <a href="index.php" class="nav-link">Home</a>
                <a href="product.php" class="nav-link">Product</a>
                <a href="member.php" class="nav-link">Member</a>
                <a href="#contact" class="nav-link">Gallery</a>
                <a href="#contact" class="nav-link">Partner</a>
                <a href="#contact" class="nav-link">Contact</a>
                <button class="button-primary">
                    <a href="dasboard.php">
                        Log in
                    </a>
                </button>
            </div>
        </nav>
    </header>