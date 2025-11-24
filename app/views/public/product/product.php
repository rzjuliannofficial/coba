<?php
require_once '../app/config/Koneksi.php'; 

function fetchAllProducts() {
    try {
        $sql = "SELECT id_produk, nama_produk, deskripsi, kategori, link_demo, image FROM produk ORDER BY id_produk DESC";
        $res = q($sql); 
        $products = pg_fetch_all($res) ?: [];
        return $products;
    } catch (RuntimeException $e) {
        error_log("Gagal mengambil produk: " . $e->getMessage());
        return [];
    }
}

$products = fetchAllProducts();
if (empty($products)) {
    $products = [
        [
            'nama_produk' => 'AMATI',
            'deskripsi' => 'Automated Cyber Security Maturity Assessment - A comprehensive security assessment tool designed to evaluate and enhance organizational cybersecurity posture.',
            'kategori' => 'Security',
            'link_demo' => '#',
            'image' => 'img/amati.png'
        ],
        [
            'nama_produk' => 'SEALS',
            'deskripsi' => 'Smart Adaptive Learning System - An intelligent learning platform that adapts to individual student needs and learning patterns for optimal educational outcomes.',
            'kategori' => 'Education',
            'link_demo' => '#',
            'image' => 'img/seals.png'
        ],
        [
            'nama_produk' => 'Agrilink Vocpro',
            'deskripsi' => 'Agricultural Vocational Professional Platform - Connecting farmers with modern agricultural technologies and best practices through innovative digital solutions.',
            'kategori' => 'Agriculture',
            'link_demo' => '#',
            'image' => 'img/ijo-removebg-preview.png'
        ],
        [
            'nama_produk' => 'CrowdEquiChain',
            'deskripsi' => 'Blockchain-based Crowdfunding Platform - Decentralized equity crowdfunding solution ensuring transparency, security, and fair distribution of investment opportunities.',
            'kategori' => 'Blockchain',
            'link_demo' => '#',
            'image' => 'img/logo_blockchain-1024x305.png'
        ],
        [
            'nama_produk' => 'OwnCloud Server',
            'deskripsi' => 'Private Cloud Storage Solution - Secure, self-hosted cloud storage platform providing complete control over your data with enterprise-grade features.',
            'kategori' => 'Cloud Storage',
            'link_demo' => '#',
            'image' => 'img/OwnCloud2-Logo.svg_-300x157.png'
        ],
        [
            'nama_produk' => 'Gitea',
            'deskripsi' => 'Self-hosted Git Service - Lightweight, fast, and reliable version control platform for managing code repositories with seamless collaboration tools.',
            'kategori' => 'DevOps',
            'link_demo' => '#',
            'image' => 'img/gitea-300x107-removebg-preview.png'
        ]
    ];
}

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Products - Lab AI Polinema</title>
    <link rel="stylesheet" href="style/Style.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <?php include '../app/views/components/header.php'; ?>

    <section class="product-hero">
        <!-- Floating Icons -->
        <i class="fas fa-rocket floating-icon" style="font-size: 3rem;"></i>
        <i class="fas fa-lightbulb floating-icon" style="font-size: 2.5rem;"></i>
        <i class="fas fa-code floating-icon" style="font-size: 3rem;"></i>
        <i class="fas fa-cogs floating-icon" style="font-size: 2.5rem;"></i>

        <div class="product-hero-content">
            <h1>Our Products</h1>
            <p class="product-hero-subtitle">Innovation Meets Excellence</p>
            <p class="product-hero-description">
                Discover our cutting-edge solutions crafted with passion and precision. 
                From AI-powered platforms to blockchain innovations, we're transforming ideas into reality.
            </p>

            <div class="hero-stats">
                <div class="stat-item">
                    <span class="stat-number">6+</span>
                    <span class="stat-label">Products</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">100+</span>
                    <span class="stat-label">Users</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">99%</span>
                    <span class="stat-label">Satisfaction</span>
                </div>
            </div>
        </div>
    </section>

    <div class="shadow-bar-top">
        <div class="half-circle-glow"></div>
    </div>

    <section class="products-section">
        <div class="container">
            <div class="products-grid">
                <?php foreach ($products as $product): ?>
                    <div class="product-card">
                        <div class="product-logo-container">
                            <img src="<?= htmlspecialchars($product['image']) ?>" 
                                 alt="<?= htmlspecialchars($product['nama_produk']) ?>">
                        </div>
                        
                        <div class="product-content">
                            <?php if (!empty($product['kategori'])): ?>
                                <span class="product-category">
                                    <?= htmlspecialchars($product['kategori']) ?>
                                </span>
                            <?php endif; ?>
                            
                            <h3 class="product-name">
                                <?= htmlspecialchars($product['nama_produk']) ?>
                            </h3>
                            
                            <?php if (!empty($product['deskripsi'])): ?>
                                <p class="product-description">
                                    <?= htmlspecialchars($product['deskripsi']) ?>
                                </p>
                            <?php endif; ?>
                            
                            <?php if (!empty($product['link_demo'])): ?>
                                <div class="product-footer">
                                    <a href="<?= htmlspecialchars($product['link_demo']) ?>" 
                                       class="product-link" 
                                       target="_blank">
                                        View Demo
                                        <i class="fas fa-arrow-right"></i>
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <?php include '../app/views/components/footer.php'; ?>
</body>
</html>