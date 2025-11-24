<?php
// Memuat file koneksi database
require_once '../app/config/Koneksi.php'; 

// Fungsi untuk mengambil semua data proyek dari tabel 'projects'
function fetchProducts() {
    try {
        $sql = "SELECT id_produk, nama_produk, deskripsi, kategori, link_demo, image FROM produk ORDER BY id_produk DESC LIMIT 3";
        $res = q($sql); 
        $products = pg_fetch_all($res) ?: [];
        return $products;
    } catch (RuntimeException $e) {
        error_log("Gagal mengambil produk: " . $e->getMessage());
        return [];
    }
}

// Fungsi untuk mengambil semua data tim dari tabel 'dosen'
function fetchTeam() {
    try {
        
        $sql = "SELECT nama, nip ,email, foto_profil, keahlian_text , deskripsi FROM dosen ORDER BY nama ASC limit 2";
        $res = q($sql);
        $team = pg_fetch_all($res) ?: [];
        return $team;
    } catch (RuntimeException $e) {
        error_log("Gagal mengambil tim: " . $e->getMessage());
        return [];
    }
}

// Ambil data sebelum memuat komponen
$team = fetchTeam();
$products = fetchProducts();

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lab AI Polinema - Inovasi Multimedia Terdepan</title>
    <link rel="stylesheet" href="style/Style.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
        <style>
        /* PENTING: Animasi `@keyframes` harus tetap menggunakan CSS murni.
           Tailwind tidak memiliki utility class bawaan untuk @keyframes. */
        @keyframes scroll-logos {
            0% {
                transform: translateX(0);
            }
            100% {
                transform: translateX(-50%); /* Menggulir separuh lebar track untuk looping */
            }
        }

        /* Kelas untuk kontainer karosel */
        .logo-carousel-container {
            width: 100%;
            background-color: transparent;
            overflow: hidden; /* Menyembunyikan bagian yang sedang bergerak */
            white-space: nowrap;
            border-radius: 12px;
            padding: 0; /* Padding disesuaikan */
            position: relative;
        }

        /* Wrapper tempat semua logo (asli + duplikat) berada */
        .logo-carousel-track {
            display: inline-block;
            width: 200%; /* Penting: Harus dua kali lebar konten untuk looping mulus */
            animation: scroll-logos 30s linear infinite; /* Animasi utama */
        }

        /* Styling Setiap Logo */
        .logo-item {
            display: inline-block;
            margin: 0; /* Jarak antar logo DIHILANGKAN */
            height: 50px; 
            line-height: 50px; /* Vertikal center */
            text-align: center;
        }
        
        .logo-item img {
            max-height: 100%;
            max-width: 120px; 
            width: auto;
            height: auto;
            object-fit: contain;
            padding-right: 1rem;
            /* Filter untuk membuat logo terlihat putih/abu-abu */
            /* filter: grayscale(100%) brightness(1.8);    
            opacity: 0.6; */
            transition: opacity 0.3s;
        }
        
        /* Catatan: Kelas fade-left dan fade-right dihilangkan
           dan digantikan dengan Tailwind utility classes di HTML. */
    </style>
</head>
<body>
    <?php include '../app/views/components/header.php'; ?>

    <section class="hero section ">
        <div class="container hero-grid">
            <div class="hero-left">
                <h1 class="hero-title">
                    Welcome to <br> 
                    <span class="gradient-text">Applied Informatics</span>
                </h1>
                <p class="hero-description">
                    The Applied Informatics Laboratory at Malang State Polytechnic is an innovation center focused on developing IT-based solutions.
                </p>
                <div class="hero-button">
                    <button class="button-primary">Explore Our Work</button>
                    <button class="button-secondary">Connect With Us</button>
                </div>
                
               <div class="w-full max-w-lg mt-8 justify-center items-center p-4">               
                    <div class="w-full max-w-md"> <!-- Lebar Maksimum tetap max-w-md --> 
                        <!-- Kontainer utama karosel -->
                        <div class="logo-carousel-container h-20 sm:h-11">
                            
                            <!-- Track Logam yang Bergerak -->
                            <div class="logo-carousel-track">
                                
                                <!-- Set Logo ASLI (6 item) -->
                                <div class="logo-item"><img src="img/OwnCloud2-Logo.svg_-300x157.png" alt="OwnCloud Logo"></div>
                                <div class="logo-item"><img src="img/seals.png" alt="SEALS Logo"></div>
                                <div class="logo-item"><img src="img/amati.png" alt="Amati Logo"></div>
                                <div class="logo-item"><img src="img/gitea-300x107-removebg-preview.png" alt="Gitea Logo"></div>
                                <div class="logo-item"><img src="img/logo_blockchain-1024x305.png" alt="CrowdEquiChain Logo"></div>
                                <div class="logo-item"><img src="img/ijo-removebg-preview.png" alt="Ijo Logo"></div>
                                
                                <!-- Set Logo DUPLIKAT (untuk efek tak terbatas) -->
                                <div class="logo-item"><img src="img/OwnCloud2-Logo.svg_-300x157.png" alt="OwnCloud Logo"></div>
                                <div class="logo-item"><img src="img/seals.png" alt="SEALS Logo"></div>
                                <div class="logo-item"><img src="img/amati.png" alt="Amati Logo"></div>
                                <div class="logo-item"><img src="img/gitea-300x107-removebg-preview.png" alt="Gitea Logo"></div>
                                <div class="logo-item"><img src="img/logo_blockchain-1024x305.png" alt="CrowdEquiChain Logo"></div>
                                <div class="logo-item"><img src="img/ijo-removebg-preview.png" alt="Ijo Logo"></div>
                                
                            </div>

                            <!-- Overlay untuk efek fading di tepi (menggunakan Tailwind Gradients) -->
                        <!-- Overlay untuk efek fading di tepi (menggunakan Tailwind Gradients) -->
                            <div class="absolute inset-0 pointer-events-none">
                                <!-- Fade Kiri: Gradasi dari warna latar belakang halaman (bg-gray-900) ke transparan -->
                                <div class="absolute left-0 top-0 bottom-0 w-1/12 bg-gradient-to-r from-[#ffffff] to-transparent"></div>
                                <!-- Fade Kanan: Gradasi dari transparan ke warna latar belakang halaman (bg-gray-900) -->
                                <div class="absolute right-0 top-0 bottom-0 w-1/12 bg-gradient-to-l from-[#ffffff] to-transparent"></div>
                            </div>
                            
                        </div>
                        
                    </div>
                </div>
            </div>
            <div class="hero-right">
                <div class="hero-image-card">
                    <img src="img/Lab.png" alt="kosong">
                </div>
            </div>
        </div>-
    </section>
    <?php include '../app/views/components/scope.php'; ?>
    <?php include '../app/views/components/news.php'; ?>
    <?php include '../app/views/components/product.php'; ?>
    <?php include '../app/views/components/member.php'; ?>
    <?php include '../app/views/components/fasilities.php'; ?>
    <?php include '../app/views/components/publication.php'; ?>
    <?php include '../app/views/components/footer.php'; ?>
    <div class="bottom-blur-overlay"></div>
</body>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
//   AOS.init();
  AOS.init({
    once: false,
    duration: 1500, // Durasi animasi 1 detik
    easing: 'ease-out',
    offset: 0,    // Jarak trigger dari bawah layar
  });
</script>
<script>
    // Dapatkan elemen yang dibutuhkan
const bottomBlur = document.querySelector('.bottom-blur-overlay');
const footer = document.querySelector('.target-hidden'); // Asumsi elemen footer Anda menggunakan tag <footer>
const blurHeight = bottomBlur ? bottomBlur.offsetHeight : 0; // Tinggi blur (2rem)

if (bottomBlur && footer) {
    
    // Fungsi untuk memeriksa posisi
    function checkVisibility() {
        // Mendapatkan posisi footer relatif terhadap viewport
        const footerRect = footer.getBoundingClientRect();

        // Kondisi: Apakah bagian atas footer (footerRect.top)
        // sudah berada di atas posisi "bottom of the viewport MINUS tinggi blur"?
        // Jika footer sudah "naik" melewati batas blur, sembunyikan blur.
        if (footerRect.top <= (window.innerHeight - blurHeight)) {
            // Sembunyikan blur saat footer mulai menyentuh area blur
            bottomBlur.classList.add('is-hidden');
        } else {
            // Tampilkan kembali blur saat footer sudah jauh di bawah
            bottomBlur.classList.remove('is-hidden');
        }
    }

    // Panggil saat scroll dan saat halaman dimuat
    window.addEventListener('scroll', checkVisibility);
    window.addEventListener('resize', checkVisibility);
    checkVisibility(); // Panggil sekali saat dimuat
} else {
    console.error("Elemen '.bottom-blur-overlay' atau 'footer' tidak ditemukan.");
}
</script>
</html>