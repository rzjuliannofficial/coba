<?php
class NewsModel extends Model {
    private $conn;
    
    public function __construct()
    {
        $this->conn = Database::connect();
    }

    public function fetchNews() {

        $sql = "SELECT 
                    b.id, 
                    b.judul, 
                    b.isi_berita, 
                    b.tanggal, 
                    b.gambar_utama,  --nanti ganti jadi image
                    b.kategori,
                    d.nama AS nama_pembuat  -- Mengambil kolom nama dari tabel users
                FROM 
                    public.berita b
                JOIN 
                    public.dosen d ON b.created_by = d.id ORDER BY b.judul Asc";

        $result = pg_query($this->conn, $sql);

        if (!$result) {
            echo "SQL ERROR: " . pg_last_error($this->conn);
            return [];
        }

        $data = [];

        while ($row = pg_fetch_assoc($result)) {
            $data[] = $row;
        }

        return $data;
    }
}