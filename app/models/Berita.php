<?php

class Berita extends Model
{
    protected $table = "berita";

    public function getAll()
    {
        $sql = "SELECT b.*, d.nama AS nama_dosen
                FROM {$this->table} b
                LEFT JOIN dosen d ON d.id = b.created_by
                ORDER BY b.id DESC";

        $res = pg_query($this->db, $sql);

        $rows = [];
        while ($row = pg_fetch_assoc($res)) $rows[] = $row;

        return $rows;
    }

    public function find($id)
    {
        $sql = "SELECT * FROM {$this->table} WHERE id=$1";
        $res = pg_query_params($this->db, $sql, [$id]);

        return $res ? pg_fetch_assoc($res) : null;
    }

    // 🔥 Wajib untuk galeri
    public function createAndReturnId($params)
    {
        $sql = "INSERT INTO {$this->table}
                (created_by, judul, isi_berita, tanggal, gambar_utama)
                VALUES ($1,$2,$3,$4,$5)
                RETURNING id";

        $res = pg_query_params($this->db, $sql, $params);
        $row = pg_fetch_assoc($res);
        return $row['id'];
    }

    public function updateData($id, $params)
    {
        $sql = "UPDATE {$this->table}
                SET judul=$1,
                    isi_berita=$2,
                    tanggal=$3,
                    gambar_utama=$4
                WHERE id=$5";

        return pg_query_params($this->db, $sql, [
            $params[0], $params[1], $params[2],
            $params[3], $id
        ]);
    }

    public function delete($id)
    {
        return pg_query_params(
            $this->db,
            "DELETE FROM {$this->table} WHERE id=$1",
            [$id]
        );
    }
}
