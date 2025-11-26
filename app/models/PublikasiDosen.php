<?php

class PublikasiDosen extends Model
{
    protected $table = "publikasi_dosen";

    public function getAll()
    {
        $sql = "SELECT pd.*, d.nama AS nama_dosen
                FROM publikasi_dosen pd
                LEFT JOIN dosen d ON d.id = pd.id
                ORDER BY pd.id DESC";

        $res = pg_query($this->db, $sql);

        $rows = [];
        while ($row = pg_fetch_assoc($res)) $rows[] = $row;
        return $rows;
    }

    public function getByDosen($id)
    {
        $sql = "SELECT pd.*, d.nama AS nama_dosen
                FROM publikasi_dosen pd
                LEFT JOIN dosen d ON d.id = pd.id
                WHERE pd.id = $1
                ORDER BY pd.id DESC";

        $res = pg_query_params($this->db, $sql, [$id]);

        $rows = [];
        while ($row = pg_fetch_assoc($res)) $rows[] = $row;
        return $rows;
    }

    public function find($id)
    {
        $sql = "SELECT * FROM {$this->table} WHERE id = $1";
        $res = pg_query_params($this->db, $sql, [$id]);
        return $res ? pg_fetch_assoc($res) : null;
    }

    public function create($params)
    {
        $sql = "INSERT INTO {$this->table}
                (id, judul, deskripsi, tahun, link_jurnal, kategori)
                VALUES ($1,$2,$3,$4,$5,$6)";

        return pg_query_params($this->db, $sql, $params);
    }

    public function updatePublikasi($id, $params)
    {
        $sql = "UPDATE {$this->table}
                SET id=$1, judul=$2, deskripsi=$3, tahun=$4, link_jurnal=$5, kategori=$6
                WHERE id=$7";

        return pg_query_params($this->db, $sql, [
            $params[0], // id
            $params[1], // judul
            $params[2], // deskripsi
            $params[3], // tahun
            $params[4], // link jurnal
            $params[5], // kategori
            $id
        ]);
    }

    public function delete($id)
    {
        return pg_query_params($this->db, "DELETE FROM {$this->table} WHERE id=$1", [$id]);
    }
}
