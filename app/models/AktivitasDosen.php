<?php

class AktivitasDosen extends Model
{
    protected $table = "aktivitas_dosen";

    public function getAll()
    {
        $sql = "SELECT ad.*, d.nama AS nama_dosen
                FROM aktivitas_dosen ad
                JOIN dosen d ON d.id = ad.id
                ORDER BY ad.id DESC";

        $res = pg_query($this->db, $sql);
        $rows = [];
        while ($row = pg_fetch_assoc($res)) $rows[] = $row;

        return $rows;
    }

    public function getByDosen($id)
    {
        $sql = "SELECT ad.*, d.nama AS nama_dosen
                FROM aktivitas_dosen ad
                JOIN dosen d ON d.id = ad.id
                WHERE id = $1
                ORDER BY ad.id DESC";

        $res = pg_query_params($this->db, $sql, [$id]);
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

    public function create($params)
    {
        $sql = "INSERT INTO {$this->table}
                (id, judul, jenis_aktivitas, tanggal, deskripsi)
                VALUES ($1,$2,$3,$4,$5)";

        return pg_query_params($this->db, $sql, $params);
    }

    public function updateAktivitas($id, $params)
    {
        $sql = "UPDATE {$this->table}
                SET id=$1, judul=$2, jenis_aktivitas=$3, tanggal=$4, deskripsi=$5
                WHERE id=$6";

        return pg_query_params($this->db, $sql, [
            $params[0], $params[1], $params[2], $params[3], $params[4], $id
        ]);
    }

    public function delete($id)
    {
        return pg_query_params($this->db, "DELETE FROM {$this->table} WHERE id=$1", [$id]);
    }
}
