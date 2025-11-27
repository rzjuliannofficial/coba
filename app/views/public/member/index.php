    <section id="team" class="section pt-0">
        <div class="member-hero-section pt-[8rem] pb-[13rem] mx-auto flex flex-col items-center bg-gradient-to-r from-[var(--blue)] to-[var(--blue-dark)]">
            <!-- Floating Icons -->
            <i class="fas fa-users floating-icon" style="font-size: 3rem;"></i>
            <i class="fas fa-graduation-cap floating-icon" style="font-size: 2.5rem;"></i>
            <i class="fas fa-brain floating-icon" style="font-size: 3rem;"></i>
            <i class="fas fa-lightbulb floating-icon" style="font-size: 2.5rem;"></i>
            <div class="relative z-10 flex items-center gap-2 text-blue-200 font-semibold mb-4" data-aos="fade-up">
                <i class="fas fa-users-viewfinder"></i> 
                <span class="uppercase tracking-wider text-sm">TEAM & LAB STRUCTURE</span>
            </div>

            <!-- Judul Utama -->
            <h2 class="text-5xl md:text-6xl font-extrabold tracking-tight mb-6 text-white" data-aos="fade-up" data-aos-delay="100">
                Meet Our Innovator Teams
            </h2>

            <!-- Deskripsi -->
            <p class="text-lg md:text-xl text-blue-100 leading-relaxed max-w-3xl mb-14 text-center" data-aos="fade-up" data-aos-delay="200">
                Meet the talented lecturers, researchers, and students who are the driving force behind innovation at the Multimedia Lab.
            </p>

            <div class="w-900 bg-blue-300/20 text-gray border-2 border-blue-50/30 rounded-2xl shadow-2xl p-8 md:p-10" data-aos="fade-up" data-aos-delay="500">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 divide-y md:divide-y-0 md:divide-x divide-gray-200">
                    
                    <!-- Item 1: Dosen -->
                    <div class="flex flex-col items-center justify-center p-2">
                        <span class="text-5xl md:text-6xl font-extrabold text-white mb-3 tracking-tighter">12</span>
                        <span class="text-gray-300 font-medium text-sm md:text-base uppercase tracking-wide">Supervising Lecturers</span>
                    </div>

                    <!-- Item 2: Mahasiswa -->
                    <div class="flex flex-col items-center justify-center p-2">
                        <span class="text-5xl md:text-6xl font-extrabold text-white mb-3 tracking-tighter">200+</span>
                        <span class="text-gray-300 font-medium text-sm md:text-base uppercase tracking-wide">Students Involved</span>
                    </div>

                    <!-- Item 3: Bidang Fokus -->
                    <div class="flex flex-col items-center justify-center p-2">
                        <span class="text-5xl md:text-6xl font-extrabold text-white mb-3 tracking-tighter">5</span>
                        <span class="text-gray-300 font-medium text-sm md:text-base uppercase tracking-wide">Research Focus Areas</span>
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
                            <div class="h-32 bg-blue-200 relative overflow-hidden">
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
                                    <?= htmlspecialchars($member['nip'] ?? 'Dosen Pengajar'); ?>
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