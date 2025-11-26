<?php

class KekayaanIntelektual extends Model
{
    protected $table = "kekayaan_intelektual";

    public function getAll()
    {
        $sql = "SELECT ki.*, d.nama AS nama_dosen
                FROM kekayaan_intelektual ki
                JOIN dosen d ON d.id = ki.id_dosen
                ORDER BY ki.id DESC";

        $res = pg_query($this->db, $sql);
        $rows = [];
        while ($row = pg_fetch_assoc($res)) $rows[] = $row;

        return $rows;
    }

    public function getByDosen($id)
    {
        $sql = "SELECT ki.*, d.nama AS nama_dosen
                FROM kekayaan_intelektual ki
                JOIN dosen d ON d.id = ki.id_dosen
                WHERE ki.id_dosen = $1
                ORDER BY ki.id DESC";

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
                (id_dosen, judul, no_permohonan, tahun)
                VALUES ($1,$2,$3,$4)";

        return pg_query_params($this->db, $sql, $params);
    }

    public function updateKI($id, $params)
    {
        $sql = "UPDATE {$this->table}
                SET id_dosen=$1,
                    judul=$2,
                    no_permohonan=$3,
                    tahun=$4
                WHERE id=$5";

        return pg_query_params($this->db, $sql, [
            $params[0],
            $params[1],
            $params[2],
            $params[3],
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
