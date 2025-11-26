
<?php

class WebsiteModel {

    public static function fetchProducts() {
        // Load file koneksi
        require_once '../config/Database.php';

        // Ambil koneksi
        $conn = Database::connect();

        $sql = "SELECT id_produk, nama_produk, deskripsi, kategori, link_demo, image 
                FROM produk 
                ORDER BY id_produk DESC 
                LIMIT 3";

        // Query PostgreSQL
        $result = pg_query($conn, $sql);

        // Kembalikan array atau array kosong
        return $result ? pg_fetch_all($result) : [];
    }

    public static function fetchTeam() {
        // Load file koneksi
        require_once '../config/Database.php';

        // Ambil koneksi
        $conn = Database::connect();

        $sql = "SELECT nama, nip, email, foto_profil, keahlian_text, deskripsi 
                FROM dosen 
                ORDER BY nama ASC 
                LIMIT 2";

        // Query PostgreSQL
        $result = pg_query($conn, $sql);

        // Kembalikan array atau array kosong
        return $result ? pg_fetch_all($result) : [];
    }
}
