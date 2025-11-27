-- ==============================================================
-- 1. CLEANUP (HAPUS DATA LAMA)
-- ==============================================================
DROP TABLE IF EXISTS public.aktivitas_dosen, public.kekayaan_intelektual, public.publikasi_lab, public.kegiatan_lab, public.penelitian_lab, public.publikasi_dosen, public.ppm, public.riset_dosen, public.berita, public.galeri, public.produk, public.fasilitas, public.users, public.dosen CASCADE;
DROP TYPE IF EXISTS public.user_role;
DROP TYPE IF EXISTS public.member_jabatan;
DROP EXTENSION IF EXISTS pgcrypto;

-- ==============================================================
-- 2. EKSTENSI & TIPE DATA CUSTOM
-- ==============================================================
CREATE EXTENSION IF NOT EXISTS pgcrypto WITH SCHEMA public;

-- Role Login
CREATE TYPE public.user_role AS ENUM (
    'admin',
    'editor'
);

-- Jabatan Struktur Lab (BARU)
CREATE TYPE public.member_jabatan AS ENUM (
    'ketua_lab',
    'asisten_lab',
    'member'
);

-- ==============================================================
-- 3. TABEL UTAMA (DOSEN & USERS TERPISAH)
-- ==============================================================

-- Tabel Dosen (Ditambah Jabatan)
CREATE TABLE public.dosen (
    id uuid DEFAULT gen_random_uuid() NOT NULL,
    nama character varying(255) NOT NULL,
    nip character varying(100),
    email character varying(255),
    foto_profil text,
    keahlian_text text,
    deskripsi text,
    jabatan public.member_jabatan DEFAULT 'member'::public.member_jabatan, -- Kolom Baru
    CONSTRAINT dosen_pkey PRIMARY KEY (id)
);

-- Tabel Users (Login Only)
CREATE TABLE public.users (
    id SERIAL NOT NULL,
    username character varying(100) NOT NULL,
    password character varying(255) NOT NULL,
    role public.user_role DEFAULT 'editor'::public.user_role NOT NULL,
    id_dosen uuid NOT NULL, 
    email CHARACTER varying(255) UNIQUE, -- Tambahan Email di user untuk login alternatif (opsional)
    CONSTRAINT users_pkey PRIMARY KEY (id),
    CONSTRAINT users_username_key UNIQUE (username),
    CONSTRAINT fk_user_dosen FOREIGN KEY (id_dosen) REFERENCES public.dosen(id) ON DELETE CASCADE
);

-- ==============================================================
-- 4. TABEL KONTEN AKADEMIK
-- ==============================================================

CREATE TABLE public.aktivitas_dosen (
    id SERIAL NOT NULL,
    id_dosen uuid NOT NULL,
    judul character varying(255) NOT NULL,
    jenis_aktivitas character varying(255),
    tanggal date,
    deskripsi text,
    CONSTRAINT aktivitas_dosen_pkey PRIMARY KEY (id),
    CONSTRAINT fk_aktivitas_dosen FOREIGN KEY (id_dosen) REFERENCES public.dosen(id) ON DELETE CASCADE
);

CREATE TABLE public.kekayaan_intelektual (
    id SERIAL NOT NULL,
    id_dosen uuid NOT NULL,
    judul character varying(255) NOT NULL,
    no_permohonan character varying(100),
    tahun character varying(20),
    CONSTRAINT kekayaan_intelektual_pkey PRIMARY KEY (id),
    CONSTRAINT fk_ki_dosen FOREIGN KEY (id_dosen) REFERENCES public.dosen(id) ON DELETE CASCADE
);

CREATE TABLE public.publikasi_lab (
    id SERIAL NOT NULL,
    id_dosen uuid NOT NULL,
    judul character varying(255) NOT NULL,
    deskripsi text,
    file_dokumen text,
    kategori character varying(100),
    CONSTRAINT publikasi_lab_pkey PRIMARY KEY (id),
    CONSTRAINT fk_publab_dosen FOREIGN KEY (id_dosen) REFERENCES public.dosen(id) ON DELETE SET NULL
);

CREATE TABLE public.kegiatan_lab (
    id SERIAL NOT NULL,
    id_dosen uuid NOT NULL,
    judul character varying(255) NOT NULL,
    deskripsi text,
    tanggal_kegiatan date,
    file_dokumentasi text,
    CONSTRAINT kegiatan_lab_pkey PRIMARY KEY (id),
    CONSTRAINT fk_keglab_dosen FOREIGN KEY (id_dosen) REFERENCES public.dosen(id) ON DELETE CASCADE
);

CREATE TABLE public.penelitian_lab (
    id SERIAL NOT NULL,
    id_dosen uuid NOT NULL,
    judul character varying(255) NOT NULL,
    deskripsi text,
    status character varying(20),
    CONSTRAINT penelitian_lab_pkey PRIMARY KEY (id),
    CONSTRAINT fk_penlab_dosen FOREIGN KEY (id_dosen) REFERENCES public.dosen(id) ON DELETE CASCADE
);

CREATE TABLE public.publikasi_dosen (
    id SERIAL NOT NULL,
    id_dosen uuid NOT NULL,
    judul character varying(255) NOT NULL,
    deskripsi text,
    tahun integer,
    link_jurnal text,
    kategori character varying(100),
    CONSTRAINT publikasi_dosen_pkey PRIMARY KEY (id),
    CONSTRAINT fk_pubdosen_dosen FOREIGN KEY (id_dosen) REFERENCES public.dosen(id) ON DELETE SET NULL
);

CREATE TABLE public.ppm (
    id SERIAL NOT NULL,
    id_dosen uuid NOT NULL,
    judul character varying(255) NOT NULL,
    tahun integer,
    CONSTRAINT ppm_pkey PRIMARY KEY (id),
    CONSTRAINT fk_ppm_dosen FOREIGN KEY (id_dosen) REFERENCES public.dosen(id) ON DELETE CASCADE
);

CREATE TABLE public.riset_dosen (
    id SERIAL NOT NULL,
    id_dosen uuid NOT NULL,
    judul character varying(255) NOT NULL,
    tahun integer,
    sumber_dana character varying(100),
    CONSTRAINT riset_dosen_pkey PRIMARY KEY (id),
    CONSTRAINT fk_riset_dosen FOREIGN KEY (id_dosen) REFERENCES public.dosen(id) ON DELETE CASCADE
);

-- ==============================================================
-- 5. TABEL KONTEN UMUM (BERITA, FASILITAS, PRODUK, GALERI)
-- ==============================================================

-- Berita (Ditambah Kategori Manual)
CREATE TABLE public.berita (
    id SERIAL NOT NULL,
    created_by uuid NOT NULL,
    judul character varying(255) NOT NULL,
    isi_berita text NOT NULL,
    tanggal date,
    gambar_utama text,
    kategori character varying(100), -- Kolom Baru
    CONSTRAINT berita_pkey PRIMARY KEY (id),
    CONSTRAINT fk_berita_dosen FOREIGN KEY (created_by) REFERENCES public.dosen(id) ON DELETE SET NULL
);

CREATE TABLE public.fasilitas (
    id_fasilitas SERIAL NOT NULL,
    nama_fasilitas character varying(255) NOT NULL,
    deskripsi text,
    kondisi character varying(50),
    foto text,
    CONSTRAINT fasilitas_pkey PRIMARY KEY (id_fasilitas)
);

CREATE TABLE public.produk (
    id SERIAL NOT NULL,
    nama_produk character varying(255) NOT NULL,
    deskripsi text,
    link_demo text,
    image text,
    kategori character varying(100),
    CONSTRAINT produk_pkey PRIMARY KEY (id)
);

-- Galeri (Ditambah Deskripsi, Tanggal, Kategori)
CREATE TABLE public.galeri (
    id SERIAL NOT NULL,
    uploaded_by uuid NOT NULL,
    file_url text NOT NULL,
    caption character varying(255), -- Judul singkat
    deskripsi text,                 -- Kolom Baru: Penjelasan panjang
    tanggal_upload timestamp DEFAULT CURRENT_TIMESTAMP, -- Kolom Baru
    kategori character varying(50), -- Kolom Baru: 'berita', 'kegiatan', dll
    
    -- Foreign Keys ke sumber data
    id_penelitian integer,
    id_kegiatan_lab integer,
    id_publikasi_lab integer,
    id_berita integer,
    id_produk integer,
    id_fasilitas integer,
    
    CONSTRAINT galeri_pkey PRIMARY KEY (id),
    CONSTRAINT fk_galeri_dosen FOREIGN KEY (uploaded_by) REFERENCES public.dosen(id) ON DELETE CASCADE,
    CONSTRAINT fk_galeri_penelitian FOREIGN KEY (id_penelitian) REFERENCES public.penelitian_lab(id) ON DELETE SET NULL,
    CONSTRAINT fk_galeri_kegiatan FOREIGN KEY (id_kegiatan_lab) REFERENCES public.kegiatan_lab(id) ON DELETE SET NULL,
    CONSTRAINT fk_galeri_publab FOREIGN KEY (id_publikasi_lab) REFERENCES public.publikasi_lab(id) ON DELETE SET NULL,
    CONSTRAINT fk_galeri_berita FOREIGN KEY (id_berita) REFERENCES public.berita(id) ON DELETE SET NULL,
    CONSTRAINT fk_galeri_produk FOREIGN KEY (id_produk) REFERENCES public.produk(id) ON DELETE SET NULL,
    CONSTRAINT fk_galeri_fasilitas FOREIGN KEY (id_fasilitas) REFERENCES public.fasilitas(id_fasilitas) ON DELETE SET NULL
);

-- ==============================================================
-- 6. SEEDING DATA (INSERT DUMMY)
-- ==============================================================

-- Insert Dosen (Lengkap dengan Jabatan & Deskripsi)
INSERT INTO public.dosen (id, nama, nip, email, foto_profil, keahlian_text, deskripsi, jabatan) VALUES
('b1a4c8f0-1e5b-4c7d-8a1a-0e9f2d1c3b4e', 'Dr. Rina Saraswati', '1975102001', 'rina.sarah@lab.id', '/img/dosen_rina.jpg', 'Deep Learning, NLP, Data Visualization', 'Kepala Laboratorium AI. Fokus penelitian utama pada Natural Language Processing.', 'ketua_lab'),
('c2b5d971-2f6c-5d8e-9b2b-1f073e2d4c5f', 'Ir. Joni Iskandar, M.Sc.', '1980051502', 'joni.iskan@lab.id', '/img/dosen_joni.jpg', 'IoT, Embedded Systems, Network Security', 'Ahli dalam sistem tertanam dan Internet of Things (IoT).', 'asisten_lab'),
('d3c6e082-377d-6f9e-a03c-27184f3e5d67', 'Dr. Kevin Sanjaya', '1988110103', 'kevin.san@lab.id', '/img/dosen_kevin.jpg', 'Web Development, Cloud Computing, Database System', 'Spesialis dalam pengembangan aplikasi web skala besar.', 'member'),
('e4d7f193-488e-770f-b14d-3829574f6e78', 'Prof. Mira Lestari', '1965030804', 'mira.les@lab.id', '/img/dosen_mira.jpg', 'Robotics, Computer Vision, AI Ethics', 'Peneliti senior di bidang Robotika dan Visi Komputer.', 'member'),
('f5e872a4-599f-8817-c25e-493a68577f89', 'Naufal Rizky, S.T., M.T.', '1992072505', 'naufal.rizky@lab.id', '/img/dosen_naufal.jpg', 'Software Engineering, Mobile Apps, UX/UI Design', 'Fokus pada Software Engineering dan pengembangan aplikasi mobile.', 'member'),
('a6f983b5-6a07-9928-d367-5a4b7968879a', 'Sonia Dewi, S.Kom., M.Kom.', '1990041206', 'sonia.d@lab.id', '/img/dosen_sonia.jpg', 'Big Data, Parallel Processing, Machine Learning Optimization', 'Ahli Big Data dan Machine Learning Optimization.', 'member'),
-- Tambahan Dosen Baru (Dengan ID UUID Valid)
('550e8400-e29b-41d4-a716-446655440000', 'Budi Santoso, M.Kom.', '1985010107', 'budi.s@lab.id', '/img/dosen_budi.jpg', 'Game Development, AR/VR', 'Dosen dengan minat khusus pada pengembangan teknologi imersif.', 'member'),
('550e8400-e29b-41d4-a716-446655440001', 'Siti Aminah, Ph.D.', '1979020208', 'siti.a@lab.id', '/img/dosen_siti.jpg', 'Cyber Security, Cryptography', 'Pakar keamanan siber dan enkripsi data.', 'member'),
('550e8400-e29b-41d4-a716-446655440002', 'Rudi Hermawan, S.T., M.T.', '1991030309', 'rudi.h@lab.id', '/img/dosen_rudi.jpg', 'Blockchain, Fintech', 'Mengembangkan solusi berbasis blockchain untuk sektor keuangan.', 'member'),
('550e8400-e29b-41d4-a716-446655440003', 'Dewi Puspita, S.Si., M.Cs.', '1989040410', 'dewi.p@lab.id', '/img/dosen_dewi.jpg', 'Bioinformatics, Computational Biology', 'Menggabungkan ilmu komputer dengan biologi molekuler.', 'member'),
('550e8400-e29b-41d4-a716-446655440004', 'Andi Wijaya, S.Kom., M.Kom.', '1993050511', 'andi.w@lab.id', '/img/dosen_andi.jpg', 'Cloud Architecture, DevOps', 'Spesialis infrastruktur cloud dan metodologi DevOps.', 'member');

-- Insert Users
INSERT INTO public.users (username, password, role, id_dosen, email) VALUES
('rina.admin', '123', 'admin', 'b1a4c8f0-1e5b-4c7d-8a1a-0e9f2d1c3b4e', 'rina.sarah@lab.id'),
('joni.editor', '123', 'editor', 'c2b5d971-2f6c-5d8e-9b2b-1f073e2d4c5f', 'joni.iskan@lab.id'),
('kevin.editor', '123', 'editor', 'd3c6e082-377d-6f9e-a03c-27184f3e5d67', 'kevin.san@lab.id'),
-- User Baru (Menggunakan ID Dosen Valid di atas)
('budi.editor', '123', 'editor', '550e8400-e29b-41d4-a716-446655440000', 'budi.s@lab.id'),
('siti.editor', '123', 'editor', '550e8400-e29b-41d4-a716-446655440001', 'siti.a@lab.id'),
('rudi.editor', '123', 'editor', '550e8400-e29b-41d4-a716-446655440002', 'rudi.h@lab.id'),
('dewi.editor', '123', 'editor', '550e8400-e29b-41d4-a716-446655440003', 'dewi.p@lab.id'),
('andi.editor', '123', 'editor', '550e8400-e29b-41d4-a716-446655440004', 'andi.w@lab.id');

-- Insert Berita
INSERT INTO public.berita (created_by, judul, isi_berita, tanggal, gambar_utama, kategori) VALUES
('b1a4c8f0-1e5b-4c7d-8a1a-0e9f2d1c3b4e', 'Lab AI Meraih Hibah Riset Rp 500 Juta', 'Dr. Rina Saraswati berhasil mendapatkan hibah besar untuk riset stunting.', '2025-11-15', '/img/berita/hibah.jpg', 'Prestasi'),
('d3c6e082-377d-6f9e-a03c-27184f3e5d67', 'Kolaborasi Lab dan Industri dalam Keamanan Cloud', 'Lab AI bekerja sama dengan TechCorp untuk pengamanan infrastruktur cloud.', '2025-11-01', '/img/berita/cloud.jpg', 'Kerjasama'),
('e4d7f193-488e-770f-b14d-3829574f6e78', 'Robot Lengan Lab AI Dipamerkan di I-Tech Expo', 'Prototipe robot Prof. Mira menarik perhatian pengunjung di pameran teknologi.', '2025-10-20', '/img/berita/expo.jpg', 'Pameran'),
-- Berita Baru (Menggunakan ID Dosen Baru)
('f5e872a4-599f-8817-c25e-493a68577f89', 'Workshop Mobile App Development 2025', 'Pelatihan intensif pengembangan aplikasi Android menggunakan Kotlin.', '2025-12-05', '/img/berita/mobile_workshop.jpg', 'Event'),
('a6f983b5-6a07-9928-d367-5a4b7968879a', 'Kuliah Tamu: Big Data di Era 5.0', 'Mengundang praktisi data dari unicorn Indonesia.', '2025-12-10', '/img/berita/kuliah_tamu.jpg', 'Akademik'),
('550e8400-e29b-41d4-a716-446655440000', 'Kompetisi Game Dev Mahasiswa', 'Ajang kreativitas mahasiswa dalam membuat game edukasi.', '2025-12-15', '/img/berita/game_dev.jpg', 'Lomba'),
('550e8400-e29b-41d4-a716-446655440001', 'Webinar Cybersecurity Awareness', 'Pentingnya menjaga data pribadi di era digital.', '2025-12-20', '/img/berita/cyber_webinar.jpg', 'Seminar'),
('550e8400-e29b-41d4-a716-446655440002', 'Peluncuran Blockchain Research Group', 'Grup riset baru yang fokus pada teknologi desentralisasi.', '2026-01-05', '/img/berita/blockchain_launch.jpg', 'Pengumuman');

-- Insert Kegiatan Lab
INSERT INTO public.kegiatan_lab (id_dosen, judul, deskripsi, tanggal_kegiatan, file_dokumentasi) VALUES
('d3c6e082-377d-6f9e-a03c-27184f3e5d67', 'Pelatihan Keamanan Web Dasar', 'Pelatihan security.', '2025-05-18', '/dok/keg_web.pdf'),
('b1a4c8f0-1e5b-4c7d-8a1a-0e9f2d1c3b4e', 'Diskusi Proyek Akhir Deep Learning', 'Sesi presentasi.', '2025-05-10', '/dok/keg_dl.pdf'),
-- Kegiatan Lab Baru
('c2b5d971-2f6c-5d8e-9b2b-1f073e2d4c5f', 'Workshop IoT untuk Smart Home', 'Perakitan perangkat pintar.', '2025-06-01', '/dok/iot_workshop.pdf'),
('f5e872a4-599f-8817-c25e-493a68577f89', 'Bootcamp UI/UX Design', 'Pelatihan desain antarmuka.', '2025-06-15', '/dok/uiux_bootcamp.pdf'),
('a6f983b5-6a07-9928-d367-5a4b7968879a', 'Data Science Hackathon', 'Kompetisi analisis data.', '2025-07-01', '/dok/hackathon.pdf'),
('550e8400-e29b-41d4-a716-446655440000', 'Game Jam 2025', 'Membuat game dalam 48 jam.', '2025-07-20', '/dok/gamejam.pdf'),
('550e8400-e29b-41d4-a716-446655440001', 'Capture The Flag (CTF) Competition', 'Kompetisi keamanan siber.', '2025-08-05', '/dok/ctf.pdf');

-- Insert Fasilitas
INSERT INTO public.fasilitas (nama_fasilitas, deskripsi, kondisi, foto) VALUES
('Server NVIDIA A100', 'Server Deep Learning.', 'Sangat Baik', '/img/fasilitas/server.jpg'),
('Robot Lengan 6 Axis', 'Robot industri kecil.', 'Baik', '/img/fasilitas/robot.jpg'),
('VR Headset Oculus Quest 2', 'Perangkat Virtual Reality untuk riset.', 'Baik', '/img/fasilitas/vr.jpg'),
('3D Printer Ender 3', 'Printer 3D untuk prototyping.', 'Perlu Perbaikan', '/img/fasilitas/3dprinter.jpg'),
('Laboratorium Komputer Mac', 'Lab dengan 20 unit iMac.', 'Sangat Baik', '/img/fasilitas/lab_mac.jpg'),
('IoT Development Kit', 'Paket lengkap sensor dan mikrokontroler.', 'Baik', '/img/fasilitas/iot_kit.jpg'),
('Ruang Podcast', 'Studio rekaman audio visual.', 'Sangat Baik', '/img/fasilitas/podcast.jpg');

-- Insert Produk
INSERT INTO public.produk (nama_produk, deskripsi, link_demo, image, kategori) VALUES
('App Penterjemah Isyarat', 'Aplikasi mobile AI.', 'http://demo.isyarat.app', '/img/produk/isyarat.jpg', 'Mobile App'),
('Sistem Smart Home', 'Kendali rumah pintar.', 'http://demo.smarthome.lab', '/img/produk/smarthome.jpg', 'IoT'),
('E-Voting Blockchain', 'Sistem pemilu aman.', 'http://evoting.lab', '/img/produk/evoting.jpg', 'Blockchain'),
('Game Edukasi Matematika', 'Belajar sambil bermain.', 'http://mathgame.lab', '/img/produk/mathgame.jpg', 'Game'),
('Deteksi Masker Wajah', 'Sistem visi komputer.', 'http://mask.lab', '/img/produk/mask.jpg', 'AI'),
('Dashboard Monitoring Energi', 'Pantau listrik real-time.', 'http://energy.lab', '/img/produk/energy.jpg', 'Web App'),
('Chatbot Layanan Akademik', 'Asisten virtual kampus.', 'http://chatbot.lab', '/img/produk/chatbot.jpg', 'AI');

-- Insert Publikasi Lab
INSERT INTO public.publikasi_lab (id_dosen, judul, deskripsi, file_dokumen, kategori) VALUES
('b1a4c8f0-1e5b-4c7d-8a1a-0e9f2d1c3b4e', 'Laporan Riset Stunting', 'Analisis data kesehatan.', '/dok/stunting.pdf', 'Laporan'),
('c2b5d971-2f6c-5d8e-9b2b-1f073e2d4c5f', 'Modul Praktikum IoT', 'Panduan belajar IoT.', '/dok/modul_iot.pdf', 'Modul Ajar'),
('d3c6e082-377d-6f9e-a03c-27184f3e5d67', 'Whitepaper Cloud Security', 'Standar keamanan cloud.', '/dok/cloud_sec.pdf', 'Whitepaper'),
('e4d7f193-488e-770f-b14d-3829574f6e78', 'Jurnal Robotika Indonesia Vol 1', 'Kumpulan paper riset.', '/dok/jurnal_robot.pdf', 'Jurnal'),
('f5e872a4-599f-8817-c25e-493a68577f89', 'Pedoman UI/UX Kampus', 'Standar desain aplikasi.', '/dok/uiux_guide.pdf', 'Pedoman'),
('a6f983b5-6a07-9928-d367-5a4b7968879a', 'Dataset Lalu Lintas Kota', 'Data open source.', '/dok/traffic_data.zip', 'Dataset');

-- Insert Penelitian Lab
INSERT INTO public.penelitian_lab (id_dosen, judul, deskripsi, status) VALUES
('b1a4c8f0-1e5b-4c7d-8a1a-0e9f2d1c3b4e', 'Penterjemah Bahasa Isyarat', 'Visi komputer.', 'Ongoing'),
('c2b5d971-2f6c-5d8e-9b2b-1f073e2d4c5f', 'Smart Parking System', 'IoT based parking.', 'Completed'),
('d3c6e082-377d-6f9e-a03c-27184f3e5d67', 'Optimasi Query Database', 'Database performance.', 'Ongoing'),
('e4d7f193-488e-770f-b14d-3829574f6e78', 'Robot Pembersih Lantai', 'Autonomous robot.', 'Planned'),
('f5e872a4-599f-8817-c25e-493a68577f89', 'Aplikasi Mental Health', 'Mobile app health.', 'Completed'),
('a6f983b5-6a07-9928-d367-5a4b7968879a', 'Prediksi Harga Saham', 'Machine Learning.', 'Ongoing');

-- Insert Aktivitas Dosen
INSERT INTO public.aktivitas_dosen (id_dosen, judul, jenis_aktivitas, tanggal, deskripsi) VALUES
('b1a4c8f0-1e5b-4c7d-8a1a-0e9f2d1c3b4e', 'Keynote Speaker Summit', 'Seminar', '2025-10-15', 'Materi NLP.'),
('c2b5d971-2f6c-5d8e-9b2b-1f073e2d4c5f', 'Juri Lomba Robotik', 'Juri', '2025-11-05', 'Menilai robot line follower.'),
('d3c6e082-377d-6f9e-a03c-27184f3e5d67', 'Workshop Laravel', 'Workshop', '2025-11-12', 'Pelatihan framework PHP.'),
('e4d7f193-488e-770f-b14d-3829574f6e78', 'Konferensi AI Global', 'Konferensi', '2025-11-20', 'Presentasi paper.'),
('f5e872a4-599f-8817-c25e-493a68577f89', 'Mentoring Startup', 'Mentoring', '2025-12-01', 'Membimbing startup mahasiswa.'),
('a6f983b5-6a07-9928-d367-5a4b7968879a', 'Reviewer Jurnal Data', 'Reviewer', '2025-12-05', 'Mereview artikel ilmiah.');

-- Insert Kekayaan Intelektual
INSERT INTO public.kekayaan_intelektual (id_dosen, judul, no_permohonan, tahun) VALUES
('b1a4c8f0-1e5b-4c7d-8a1a-0e9f2d1c3b4e', 'Metode Klasifikasi Teks', 'P002025001', '2025'),
('c2b5d971-2f6c-5d8e-9b2b-1f073e2d4c5f', 'Desain Alat IoT', 'D002025002', '2025'),
('d3c6e082-377d-6f9e-a03c-27184f3e5d67', 'Kode Sumber Web App', 'C002025003', '2025'),
('e4d7f193-488e-770f-b14d-3829574f6e78', 'Algoritma Navigasi', 'P002025004', '2025'),
('f5e872a4-599f-8817-c25e-493a68577f89', 'Desain Antarmuka Mobile', 'D002025005', '2025'),
('a6f983b5-6a07-9928-d367-5a4b7968879a', 'Model Prediksi Cuaca', 'P002025006', '2025');

-- Insert Publikasi Dosen
INSERT INTO public.publikasi_dosen (id_dosen, judul, deskripsi, tahun, link_jurnal, kategori) VALUES
('b1a4c8f0-1e5b-4c7d-8a1a-0e9f2d1c3b4e', 'NLP for Bahasa Indonesia', 'Penelitian bahasa.', 2024, 'http://jurnal.id/nlp', 'Jurnal Internasional'),
('c2b5d971-2f6c-5d8e-9b2b-1f073e2d4c5f', 'IoT Security Challenges', 'Keamanan IoT.', 2024, 'http://jurnal.id/iot', 'Prosiding'),
('d3c6e082-377d-6f9e-a03c-27184f3e5d67', 'Scalable Web Architecture', 'Arsitektur web.', 2023, 'http://jurnal.id/web', 'Jurnal Nasional'),
('e4d7f193-488e-770f-b14d-3829574f6e78', 'Ethical AI Framework', 'Etika AI.', 2025, 'http://jurnal.id/ai', 'Jurnal Internasional'),
('f5e872a4-599f-8817-c25e-493a68577f89', 'UX Trends in 2025', 'Tren desain.', 2025, 'http://jurnal.id/ux', 'Artikel Ilmiah'),
('a6f983b5-6a07-9928-d367-5a4b7968879a', 'Big Data in Healthcare', 'Data kesehatan.', 2024, 'http://jurnal.id/bigdata', 'Jurnal Internasional');

-- Insert PPM
INSERT INTO public.ppm (id_dosen, judul, tahun) VALUES
('b1a4c8f0-1e5b-4c7d-8a1a-0e9f2d1c3b4e', 'Pelatihan Guru SMA', 2024),
('c2b5d971-2f6c-5d8e-9b2b-1f073e2d4c5f', 'Digitalisasi UMKM Desa', 2023),
('d3c6e082-377d-6f9e-a03c-27184f3e5d67', 'Workshop Coding Anak Panti', 2024),
('e4d7f193-488e-770f-b14d-3829574f6e78', 'Penyuluhan Teknologi Tepat Guna', 2025),
('f5e872a4-599f-8817-c25e-493a68577f89', 'Pendampingan Start-up Lokal', 2023),
('a6f983b5-6a07-9928-d367-5a4b7968879a', 'Edukasi Internet Sehat', 2024);

-- Insert Riset Dosen
INSERT INTO public.riset_dosen (id_dosen, judul, tahun, sumber_dana) VALUES
('b1a4c8f0-1e5b-4c7d-8a1a-0e9f2d1c3b4e', 'Analisis Sentimen Pemilu', 2024, 'Internal'),
('c2b5d971-2f6c-5d8e-9b2b-1f073e2d4c5f', 'Smart Farming IoT', 2023, 'Dikti'),
('d3c6e082-377d-6f9e-a03c-27184f3e5d67', 'Optimasi Cloud Storage', 2024, 'Industri'),
('e4d7f193-488e-770f-b14d-3829574f6e78', 'Robot SAR Otonom', 2025, 'LPDP'),
('f5e872a4-599f-8817-c25e-493a68577f89', 'Aplikasi Belajar Bahasa', 2023, 'Mandiri'),
('a6f983b5-6a07-9928-d367-5a4b7968879a', 'Prediksi Banjir Jakarta', 2024, 'Pemprov');

-- Insert Galeri (Lengkap dengan Kolom Baru)
INSERT INTO public.galeri (uploaded_by, file_url, caption, deskripsi, kategori, tanggal_upload, id_kegiatan_lab, id_fasilitas, id_berita, id_produk, id_penelitian, id_publikasi_lab) VALUES
-- Data Lama (Updated with defaults)
('d3c6e082-377d-6f9e-a03c-27184f3e5d67', '/galeri/foto_keg_web.jpg', 'Sesi Praktikum', 'Mahasiswa sedang melakukan penetrasi tes pada server lokal.', 'Kegiatan Lab', '2025-05-19 10:00:00', 1, NULL, NULL, NULL, NULL, NULL),
('b1a4c8f0-1e5b-4c7d-8a1a-0e9f2d1c3b4e', 'galeri/foto_server.jpg', 'Server A100', 'Rak server utama yang terletak di ruang pendingin.', 'Fasilitas', '2025-01-10 09:00:00', NULL, 1, NULL, NULL, NULL, NULL),
-- Tambahan Galeri Baru
('e4d7f193-488e-770f-b14d-3829574f6e78', 'galeri/pameran_robot.jpg', 'Demo Robot', 'Prof Mira mendemokan robot lengan di depan pengunjung.', 'Berita', '2025-10-21 14:00:00', NULL, NULL, 3, NULL, NULL, NULL),
('f5e872a4-599f-8817-c25e-493a68577f89', 'galeri/apps_ui.png', 'UI Design', 'Tampilan antarmuka aplikasi penterjemah.', 'Produk', '2025-02-01 08:00:00', NULL, NULL, NULL, 1, NULL, NULL),
('c2b5d971-2f6c-5d8e-9b2b-1f073e2d4c5f', 'galeri/iot_kit_detail.jpg', 'IoT Kit', 'Detail komponen dalam kit pembelajaran IoT.', 'Fasilitas', '2025-03-05 11:00:00', NULL, 5, NULL, NULL, NULL, NULL),
('a6f983b5-6a07-9928-d367-5a4b7968879a', 'galeri/seminar_bigdata.jpg', 'Suasana Seminar', 'Antusiasme peserta seminar Big Data.', 'Berita', '2025-07-26 09:30:00', NULL, NULL, 6, NULL, NULL, NULL),
('d3c6e082-377d-6f9e-a03c-27184f3e5d67', 'galeri/server_maintenance.jpg', 'Maintenance', 'Kegiatan perawatan rutin server lab.', 'Kegiatan Lab', '2025-06-10 16:00:00', 4, NULL, NULL, NULL, NULL, NULL);