<?php

function fetchTeam() {
    try {
        
        $sql = "SELECT nama,email , jabatan ,  nip_nim , foto_profil, keahlian_text , deskripsi FROM dosen ORDER BY nama ASC";
        $res = q($sql);
        $team = pg_fetch_all($res) ?: [];
        return $team;
    } catch (RuntimeException $e) {
        error_log("Gagal mengambil tim: " . $e->getMessage());
        return [];
    }
}
if (empty($products)) {
    $team = [
        [
            'id'            => 'b1a4c8f0-1e5b-4c7d-8a1a-0e9f2d1c3b4e',
            'username'      => 'rina.admin',
            'password'      => password_hash('123', PASSWORD_DEFAULT), // Hash password!
            'email'         => 'rina.sarah@lab.id',
            'nama'          => 'Dr. Rina Saraswati',
            'nip_nim'       => '1975102001',
            'jabatan'       => 'ketua_lab', // Enum: ketua_lab, asisten_lab, member
            'keahlian_text' => 'Deep Learning, NLP, Data Visualization',
            'deskripsi'     => 'Kepala Laboratorium AI. Fokus penelitian pada NLP dan Deep Learning.',
            'foto_profil'   => 'img/goats.png',
            'role'          => 'admin' // Enum: admin, editor
        ],
        [
            'id'            => 'c2b5d971-2f6c-5d8e-9b2b-1f073e2d4c5f',
            'username'      => 'joni.editor',
            'password'      => password_hash('123', PASSWORD_DEFAULT),
            'email'         => 'joni.iskan@lab.id',
            'nama'          => 'Ir. Joni Iskandar, M.Sc.',
            'nip_nim'       => '1980051502',
            'jabatan'       => 'member',
            'keahlian_text' => 'IoT, Embedded Systems, Network Security',
            'deskripsi'     => 'Ahli sistem tertanam dan IoT.',
            'foto_profil'   => 'img/goats.png',
            'role'          => 'editor'
        ],
        [
            'id'            => 'd3c6e082-377d-6f9e-a03c-27184f3e5d67',
            'username'      => 'kevin.editor',
            'password'      => password_hash('123', PASSWORD_DEFAULT),
            'email'         => 'kevin.san@lab.id',
            'nama'          => 'Dr. Kevin Sanjaya',
            'nip_nim'       => '1988110103',
            'jabatan'       => 'asisten_lab',
            'keahlian_text' => 'Web Development, Cloud Computing, Database System',
            'deskripsi'     => 'Spesialis pengembangan aplikasi web skala besar dan Cloud.',
            'foto_profil'   => 'img/goats.png',
            'role'          => 'editor'
        ],
        [
            'id'            => 'e4d7f193-488e-770f-b14d-3829574f6e78',
            'username'      => 'mira.admin',
            'password'      => password_hash('123', PASSWORD_DEFAULT),
            'email'         => 'mira.les@lab.id',
            'nama'          => 'Prof. Mira Lestari',
            'nip_nim'       => '1965030804',
            'jabatan'       => 'member',
            'keahlian_text' => 'Robotics, Computer Vision, AI Ethics',
            'deskripsi'     => 'Peneliti senior bidang Robotika dan Etika AI.',
            'foto_profil'   => 'img/goats.png',
            'role'          => 'admin'
        ],
        [
            'id'            => 'f5e872a4-599f-8817-c25e-493a68577f89',
            'username'      => 'naufal.editor',
            'password'      => password_hash('123', PASSWORD_DEFAULT),
            'email'         => 'naufal.rizky@lab.id',
            'nama'          => 'Naufal Rizky, S.T., M.T.',
            'nip_nim'       => '1992072505',
            'jabatan'       => 'member', 
            'keahlian_text' => 'Software Engineering, Mobile Apps, UX/UI Design',
            'deskripsi'     => 'Fokus pada Software Engineering dan UX Mobile Apps.',
            'foto_profil'   => 'img/goats.png',
            'role'          => 'editor'
        ],
        [
            'id'            => 'a6f983b5-6a07-9928-d367-5a4b7968879a',
            'username'      => 'sonia.editor',
            'password'      => password_hash('123', PASSWORD_DEFAULT),
            'email'         => 'sonia.d@lab.id',
            'nama'          => 'Sonia Dewi, S.Kom., M.Kom.',
            'nip_nim'       => '1990041206',
            'jabatan'       => 'member',
            'keahlian_text' => 'Big Data, Parallel Processing, ML Optimization',
            'deskripsi'     => 'Ahli optimasi Machine Learning dan Big Data.',
            'foto_profil'   => 'img/goats.png',
            'role'          => 'editor'
        ]
    ];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style/Style.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>
<body>
    <?php include '../app/views/components/header.php'; ?>
    <section id="team" class="section pt-0">
        <div class="pt-[8rem] pb-[13rem] mx-auto flex flex-col items-center bg-gradient-to-r from-[var(--blue)] to-[var(--blue-dark)]">
            <div class="flex items-center gap-2 text-blue-200 font-semibold mb-4" data-aos="fade-up">
                <i class="fas fa-users-viewfinder"></i> 
                <span class="uppercase tracking-wider text-sm">TIM & STRUKTUR LAB</span>
            </div>

            <!-- Judul Utama -->
            <h2 class="text-5xl md:text-6xl font-extrabold tracking-tight mb-6 text-white" data-aos="fade-up" data-aos-delay="100">
                Kenali Tim Inovator Kami
            </h2>

            <!-- Deskripsi -->
            <p class="text-lg md:text-xl text-blue-100 leading-relaxed max-w-3xl mb-14 text-center" data-aos="fade-up" data-aos-delay="200">
                Bertemu dengan para dosen, peneliti, dan mahasiswa berbakat yang menjadi motor penggerak inovasi di Lab Multimedia.
            </p>

            <div class="w-900 bg-blue-300/20 text-gray border-2 border-blue-50/30 rounded-2xl shadow-2xl p-8 md:p-10" data-aos="fade-up" data-aos-delay="500">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 divide-y md:divide-y-0 md:divide-x divide-gray-200">
                    
                    <!-- Item 1: Dosen -->
                    <div class="flex flex-col items-center justify-center p-2">
                        <span class="text-5xl md:text-6xl font-extrabold text-white mb-3 tracking-tighter">12</span>
                        <span class="text-gray-300 font-medium text-sm md:text-base uppercase tracking-wide">Dosen Pembimbing</span>
                    </div>

                    <!-- Item 2: Mahasiswa -->
                    <div class="flex flex-col items-center justify-center p-2">
                        <span class="text-5xl md:text-6xl font-extrabold text-white mb-3 tracking-tighter">200+</span>
                        <span class="text-gray-300 font-medium text-sm md:text-base uppercase tracking-wide">Mahasiswa Terlibat</span>
                    </div>

                    <!-- Item 3: Bidang Fokus -->
                    <div class="flex flex-col items-center justify-center p-2">
                        <span class="text-5xl md:text-6xl font-extrabold text-white mb-3 tracking-tighter">5</span>
                        <span class="text-gray-300 font-medium text-sm md:text-base uppercase tracking-wide">Bidang Fokus Penelitian</span>
                    </div>

                </div>
            </div>
        </div>

        <div class="container mt-[5rem]">
            <!--  Grid Card -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 px-4">
                <?php if (count($team) > 0): ?>
                    <?php 
                        $delay_increment = 200; // Penambahan delay 200 milidetik per kartu
                        $delay = 0; 
                    ?>
                    <!-- Card Member -->
                    <?php foreach ($team as $member): ?>
                    <div data-aos="fade-up" data-aos-delay="<?= $delay; ?>" class="h-full">
                        <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden
                                    flex flex-col h-full shadow-[0px_5px_10px_rgba(5,0,5,0.05)] 
                                    transition-all duration-300 hover:-translate-y-2 
                                    hover:shadow-[0_20px_40px_rgba(6,182,212,0.15)]">
                            <!-- profile -->
                            <div class="h-50 bg-blue-200 relative overflow-hidden">
                                <?php if (!empty($member['foto_profil'])): ?>
                                        <img src="<?= htmlspecialchars($member['foto_profil']); ?>" alt="<?= htmlspecialchars($member['nama']); ?>" class="w-full h-full object-cover">
                                    <?php else: ?>
                                        <svg class="w-12 h-12 text-gray-300" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                        </svg>
                                    <?php endif; ?>
                                <span class="absolute top-4 right-4 bg-slate-500 text-white text-[12px] font-bold px-3 py-1 rounded-full uppercase tracking-wide">
                                    <?= htmlspecialchars($member['jabatan']); ?>
                                </span>
                            </div>  
                            
                            <!-- main profile -->
                            <div class="px-6 flex-grow flex flex-col mt-5">
                                <h3 class="text-xl font-bold text-gray-900 leading-tight mb-2">
                                    <?= htmlspecialchars($member['nama']); ?>
                                </h3>
                                <p class="text-slate-500 text-sm mb-6">
                                    <?= htmlspecialchars($member['nip_nim'] ?? 'Dosen Pengajar'); ?>
                                </p>

                                <p class="text-[13px] font-bold text-gray-800 uppercase tracking-wider mb-3">
                                    MINAT PENELITIAN:
                                </p>

                                <div class="flex flex-wrap gap-2 mb-6">
                                    <?php 
                                    $keahlian = $member['keahlian_text'] ?? '';
                                    if (!empty($keahlian)) {
                                        $skills = explode(',', $keahlian);
                                        // Tampilkan maksimal 3 skill agar kartu tidak kepanjangan
                                        $skills = array_slice($skills, 0, 3); 
                                        foreach ($skills as $skill): ?>
                                            <span class="bg-gradient-to-r from-[var(--blue-light)] to-[var(--blue)] text-white text-[12px] px-3 py-1 rounded-full font-semibold uppercase">
                                                <?= htmlspecialchars(trim($skill)); ?>
                                            </span>
                                    <?php endforeach; } else { ?>
                                        <span class="text-gray-400 text-xs italic">-</span>
                                    <?php } ?>
                                </div>
                            </div>

                            <!-- footer card -->
                            <div class="px-6 py-4 mt-auto border-t border-gray-100 flex items-center justify-between text-gray-400">
                                <div class="flex space-x-4">
                                    <a href="#" class="hover:text-slate-600 transition-colors"><i class="fas fa-user-graduate text-lg"></i></a>
                                    <a href="#" class="hover:text-blue-600 transition-colors"><i class="fab fa-linkedin text-lg"></i></a>
                                </div>
                                
                                <div>
                                    <a href="mailto:<?= htmlspecialchars($member['email']); ?>" class="hover:text-red-500 transition-colors">
                                        <i class="far fa-envelope text-lg"></i>
                                    </a>
                                </div>
                            </div>
                            <?php 
                                //Tambah delay untuk kartu berikutnya
                                $delay += $delay_increment; 
                            ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="col-span-3 text-center text-gray-500 py-10">Belum ada data tim (dosen) yang tersedia.</p>
                <?php endif; ?>
            </div>
        </div>
    </section>
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