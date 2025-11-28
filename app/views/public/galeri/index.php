<section class="gallery-hero">
        <!-- Floating Icons -->
        <i class="fas fa-camera floating-icon" style="font-size: 3rem;"></i>
        <i class="fas fa-images floating-icon" style="font-size: 2.5rem;"></i>
        <i class="fas fa-palette floating-icon" style="font-size: 3rem;"></i>
        <i class="fas fa-star floating-icon" style="font-size: 2.5rem;"></i>

        <div class="gallery-hero-content">
            <h1>Capturing Our Journey,</h1>
            <h1 class="hero-highlight">One Moment at a Time</h1>
            <p class="gallery-hero-description">
                Documenting the innovation, dedication, and achievements of Lab AI Polinema,
                preserving memorable moments to inspire forever
            </p>
        </div>
    </section>

    <!-- Gallery Carousel Section -->
    <div class="w-full flex justify-center items-center py-8 bg-transparent">
        <div class="w-full max-w-6xl px-4">
            <!-- Kontainer utama karosel -->
            <div class="logo-carousel-container" style="height: 360px;">
                
                <!-- Track Gallery yang Bergerak -->
                <div class="logo-carousel-track">
                    
                    <!-- Set Gallery ASLI -->
                    <?php foreach ($galleryItems as $item): ?>
                    <div class="carousel-card">
                        <div class="carousel-card-inner">
                            <img src="<?= htmlspecialchars($item['file_url'] ?? '') ?>" alt="<?= htmlspecialchars($item['caption'] ?? '') ?>">
                            <div class="carousel-card-content">
                                <h3 class="carousel-card-title"><?= htmlspecialchars($item['caption'] ?? '') ?></h3>
                                <div class="carousel-card-date">
                                    <i class="fas fa-calendar"></i>
                                    <span><?= date('M d, Y', strtotime($item['tanggal_upload'] ?? '')) ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                    
                    <!-- Set Gallery DUPLIKAT (untuk efek tak terbatas) -->
                    <?php foreach ($galleryItems as $item): ?>
                    <div class="carousel-card">
                        <div class="carousel-card-inner">
                            <img src="<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['title']) ?>">
                            <div class="carousel-card-content">
                                <h3 class="carousel-card-title"><?= htmlspecialchars($item['title']) ?></h3>
                                <div class="carousel-card-date">
                                    <i class="fas fa-calendar"></i>
                                    <span><?= date('M d, Y', strtotime($item['upload_date'])) ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                    
                </div>

                <!-- Overlay untuk efek fading di tepi (menggunakan Tailwind Gradients) -->
                <div class="absolute inset-0 pointer-events-none">
                    <!-- Fade Kiri: Gradasi dari warna latar belakang halaman ke transparan -->
                    <div class="absolute left-0 top-0 bottom-0 w-1/12 bg-gradient-to-r from-[#ffffff] to-transparent"></div>
                    <!-- Fade Kanan: Gradasi dari transparan ke warna latar belakang halaman -->
                    <div class="absolute right-0 top-0 bottom-0 w-1/12 bg-gradient-to-l from-[#ffffff] to-transparent"></div>
                </div>
                
            </div>
        </div>
    </div>

    <div class="shadow-bar-top">
        <div class="half-circle-glow"></div>
    </div>

    <section class="gallery-section">
        <div class="container">
            <!-- Filter Buttons -->
            <div class="gallery-filters">
                <button class="filter-btn active" data-filter="all">All</button>
                <button class="filter-btn" data-filter="Workshop">Workshop</button>
                <button class="filter-btn" data-filter="Competition">Competition</button>
                <button class="filter-btn" data-filter="Event">Event</button>
                <button class="filter-btn" data-filter="Research">Research</button>
                <button class="filter-btn" data-filter="Academic">Academic</button>
            </div>

            <!-- Masonry Gallery Grid -->
            <div class="gallery-masonry">
                <?php foreach ($galleryItems as $index => $item): ?>
                    <div class="gallery-item" data-category="<?= htmlspecialchars($item['kategori']) ?>">
                        <div class="gallery-card">
                            <div class="gallery-image-container">
                                <img src="<?= htmlspecialchars($item['file_url']) ?>" 
                                     alt="<?= htmlspecialchars($item['caption']) ?>"
                                     loading="lazy">
                                <div class="gallery-overlay">
                                    <div class="gallery-overlay-content">
                                        <span class="gallery-category-badge">
                                            <?= htmlspecialchars($item['kategori']) ?>
                                        </span>
                                        <h3 class="gallery-item-title">
                                            <?= htmlspecialchars($item['caption']) ?>
                                        </h3>
                                        <p class="gallery-item-description">
                                            <?= htmlspecialchars($item['deskripsi']) ?>
                                        </p>
                                        <div class="gallery-meta">
                                            <span class="gallery-uploader">
                                                <i class="fas fa-user"></i>
                                                <?= htmlspecialchars($item['uploaded_by']) ?>
                                            </span>
                                            <span class="gallery-date">
                                                <i class="fas fa-calendar"></i>
                                                <?= date('M d, Y', strtotime($item['taggal_upload'])) ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>