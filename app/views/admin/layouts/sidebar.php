<aside class="w-64 fixed top-0 left-0 h-full shadow-2xl z-40 bg-[#1F2937] text-white">
    <div class="p-6 h-full overflow-y-auto">

        <!-- Logo -->
        <div class="flex items-center space-x-3 mb-6">
            <div class="w-10 h-10 rounded-full bg-white flex items-center justify-center">
                <i class="fas fa-brain text-xl text-blue-800"></i>
            </div>
            <span class="text-xl font-bold text-white">AI Lab Admin</span>
        </div>

        <!-- User Info -->
        <div class="mb-8 p-3 bg-gray-700/50 rounded-lg">
            <div class="flex items-center space-x-3">
                <img src="https://placehold.co/40x40/f97316/ffffff?text=A"
                     class="w-10 h-10 rounded-full object-cover">
                <div>
                    <p class="text-white font-semibold">
                        <?= $_SESSION['user']['username'] ?? 'Admin'; ?>
                    </p>
                    <p class="text-xs text-green-400">
                        <i class="fas fa-circle mr-1 text-xs"></i>Online
                    </p>
                </div>
            </div>
        </div>

        <!-- Menu -->
        <nav class="space-y-1">

            <a href="/admin/dashboard" class="flex items-center p-3 rounded-lg hover:bg-gray-700">
                <i class="fas fa-chart-line w-5 mr-3"></i>Dashboard
            </a>

            <p class="text-xs text-gray-400 uppercase pt-4 pb-1 px-3">Manajemen Data</p>

            <a href="/admin/Dosen" class="flex items-center p-3 hover:bg-gray-700">
                <i class="fas fa-user-tie w-5 mr-3"></i>Dosen
            </a>


            <!-- DROPDOWN 1 -->
            <div class="dropdown-group">
                <button class="dropdown-btn flex items-center justify-between w-full p-3 hover:bg-gray-700 rounded-lg">
                    <span class="flex items-center">
                        <i class="fas fa-book w-5 mr-3"></i>
                        Publikasi & Kegiatan Dosen
                    </span>
                    <i class="fas fa-chevron-right dropdown-icon transition-transform"></i>
                </button>

                <div class="dropdown-menu ml-10 mt-1 space-y-1 hidden">
                    <a href="/admin/PublikasiDosen" class="block p-2 text-gray-300 hover:bg-gray-700 rounded">Publikasi Ilmiah</a>
                    <a href="/admin/AktivitasDosen" class="block p-2 text-gray-300 hover:bg-gray-700 rounded">Aktivitas Dosen</a>
                    <a href="/admin/Ppm" class="block p-2 text-gray-300 hover:bg-gray-700 rounded">PPM</a>
                    <a href="/admin/RisetDosen" class="block p-2 text-gray-300 hover:bg-gray-700 rounded">Riset Dosen</a>
                    <a href="/admin/KekayaanIntelektual" class="block p-2 text-gray-300 hover:bg-gray-700 rounded">Kekayaan Intelektual</a>
                </div>
            </div>


            <!-- DROPDOWN 2 -->
            <div class="dropdown-group">
                <button class="dropdown-btn flex items-center justify-between w-full p-3 hover:bg-gray-700 rounded-lg">
                    <span class="flex items-center">
                        <i class="fas fa-flask w-5 mr-3"></i>
                        Publikasi & Penelitian Lab
                    </span>
                    <i class="fas fa-chevron-right dropdown-icon transition-transform"></i>
                </button>

                <div class="dropdown-menu ml-10 mt-1 space-y-1 hidden">
                    <a href="/admin/PublikasiLab" class="block p-2 text-gray-300 hover:bg-gray-700 rounded">Publikasi Lab</a>
                    <a href="/admin/PenelitianLab" class="block p-2 text-gray-300 hover:bg-gray-700 rounded">Penelitian Lab</a>
                    <a href="/admin/KegiatanLab" class="block p-2 text-gray-300 hover:bg-gray-700 rounded">Kegiatan Lab</a>
                </div>
            </div>


            <!-- Other menus khusus admin -->
            <?php if ($_SESSION['user']['role'] === 'admin'): ?>
            <a href="/admin/Berita" class="flex items-center p-3 text-gray-300 hover:bg-gray-700">
                <i class="fas fa-newspaper w-5 mr-3"></i>Berita
            </a>

            <?php endif; ?>
            <?php if ($_SESSION['user']['role'] === 'admin'): ?>
            <a href="/admin/Produk" class="flex items-center p-3 text-gray-300 hover:bg-gray-700">
                <i class="fas fa-shopping w-5 mr-3"></i>Produk
            </a>
            <?php endif; ?>

            <?php if ($_SESSION['user']['role'] === 'admin'): ?>
            <a href="/admin/Fasilitas" class="flex items-center p-3 text-gray-300 hover:bg-gray-700">
                <i class="fas fa-building w-5 mr-3"></i>Fasilitas
            </a>
            <?php endif; ?>
            
            <?php if ($_SESSION['user']['role'] === 'admin'): ?>
            <a href="/admin/galeri" class="flex items-center p-3 text-gray-300 hover:bg-gray-700">
                <i class="fas fa-images w-5 mr-3"></i>Galeri
            </a>
            <?php endif; ?>

            <?php if ($_SESSION['user']['role'] === 'admin'): ?>
            <a href="/admin/User" class="flex items-center p-3 hover:bg-gray-700">
                <i class="fas fa-user-shield w-5 mr-3"></i>Kelola User
            </a>
            <?php endif; ?>
        </nav>

        <p class="text-xs text-gray-400 uppercase pt-4 pb-1 px-3">Sistem</p>

        <a href="/admin/logout" class="flex items-center p-3 rounded-lg text-red-400 hover:bg-gray-700">
            <i class="fas fa-sign-out-alt w-5 mr-3"></i>Logout
        </a>

    </div>
</aside>

<!-- DROPDOWN SCRIPT TANPA ALPINE -->
<script>
    document.querySelectorAll('.dropdown-group').forEach(group => {
        const btn = group.querySelector('.dropdown-btn');
        const menu = group.querySelector('.dropdown-menu');
        const icon = group.querySelector('.dropdown-icon');

        btn.addEventListener('click', () => {
            menu.classList.toggle('hidden');
            icon.classList.toggle('rotate-90');
        });
    });
</script>
