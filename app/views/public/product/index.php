

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
