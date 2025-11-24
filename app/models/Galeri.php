<?php

class Galeri extends Model
{
    protected $table = "galeri";

    public function getAll()
    {
        $sql = "SELECT 
                    g.*,
                    d.nama AS nama_uploader,
                    pl.judul  AS judul_penelitian,
                    kl.judul  AS judul_kegiatan,
                    publ.judul AS judul_publikasi_lab,
                    b.judul   AS judul_berita,
                    pr.nama_produk,
                    f.nama_fasilitas
                FROM galeri g
                LEFT JOIN dosen d ON d.id = g.uploaded_by
                LEFT JOIN penelitian_lab pl ON pl.id = g.id_penelitian
                LEFT JOIN kegiatan_lab   kl ON kl.id = g.id_kegiatan_lab
                LEFT JOIN publikasi_lab  publ ON publ.id = g.id_publikasi_lab
                LEFT JOIN berita         b ON b.id = g.id_berita
                LEFT JOIN produk         pr ON pr.id = g.id_produk
                LEFT JOIN fasilitas      f ON f.id_fasilitas = g.id_fasilitas
                ORDER BY g.id DESC";

        $res = pg_query($this->db, $sql);
        $rows = [];
        while ($row = pg_fetch_assoc($res)) {
            $rows[] = $row;
        }
        return $rows;
    }

    public function find($id)
    {
        $sql = "SELECT * FROM {$this->table} WHERE id=$1";
        $res = pg_query_params($this->db, $sql, [$id]);
        return $res ? pg_fetch_assoc($res) : null;
    }

    public function create($data)
    {
        // data: [uploaded_by, file_url, caption, id_penelitian, id_kegiatan_lab, id_publikasi_lab, id_berita, id_produk, id_fasilitas]
        $sql = "INSERT INTO {$this->table}
                (uploaded_by, file_url, caption, id_penelitian, id_kegiatan_lab, id_publikasi_lab, id_berita, id_produk, id_fasilitas)
                VALUES ($1,$2,$3,$4,$5,$6,$7,$8,$9)";
        return pg_query_params($this->db, $sql, $data);
    }

    public function updateCaption($id, $caption)
    {
        $sql = "UPDATE {$this->table} SET caption=$1 WHERE id=$2";
        return pg_query_params($this->db, $sql, [$caption, $id]);
    }

    public function delete($id)
    {
        // Hanya hapus record galeri, BUKAN file fisiknya,
        // karena file masih dipakai di fitur asal (produk/fasilitas/berita dst).
        return pg_query_params($this->db,
            "DELETE FROM {$this->table} WHERE id=$1",
            [$id]
        );
    }
}
