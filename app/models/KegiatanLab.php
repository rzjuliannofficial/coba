<?php

class KegiatanLab extends Model
{
    protected $table = "kegiatan_lab";

    public function getAll()
    {
        $sql = "SELECT kl.*, d.nama AS nama_dosen
                FROM kegiatan_lab kl
                JOIN dosen d ON d.id = kl.id_dosen
                ORDER BY kl.id DESC";

        $res = pg_query($this->db, $sql);

        $rows = [];
        while ($row = pg_fetch_assoc($res)) $rows[] = $row;

        return $rows;
    }

    public function getByDosen($id)
    {
        $sql = "SELECT kl.*, d.nama AS nama_dosen
                FROM kegiatan_lab kl
                JOIN dosen d ON d.id = kl.id_dosen
                WHERE kl.id_dosen = $1
                ORDER BY kl.id DESC";

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
            (id_dosen, judul, deskripsi, tanggal_kegiatan, file_dokumentasi)
            VALUES ($1,$2,$3,$4,$5)";

        return pg_query_params($this->db, $sql, $params);
    }

    public function updateData($id, $params)
    {
        $sql = "UPDATE {$this->table}
            SET id_dosen=$1,
                judul=$2,
                deskripsi=$3,
                tanggal_kegiatan=$4,
                file_dokumentasi=$5
            WHERE id=$6";

        return pg_query_params($this->db, $sql, [
            $params[0],
            $params[1],
            $params[2],
            $params[3],
            $params[4],
            $id
        ]);
    }

    public function delete($id)
    {
        return pg_query_params($this->db,
            "DELETE FROM {$this->table} WHERE id=$1",
            [$id]
        );
    }
}
