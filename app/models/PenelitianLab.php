<?php

class PenelitianLab extends Model
{
    protected $table = "penelitian_lab";

    public function getAll()
    {
        $sql = "SELECT pl.*, d.nama AS nama_dosen
                FROM penelitian_lab pl
                JOIN dosen d ON d.id = pl.id_dosen
                ORDER BY pl.id DESC";

        $res = pg_query($this->db, $sql);
        $rows = [];
        while ($row = pg_fetch_assoc($res)) $rows[] = $row;

        return $rows;
    }

    public function getByDosen($id)
    {
        $sql = "SELECT pl.*, d.nama AS nama_dosen
                FROM penelitian_lab pl
                JOIN dosen d ON d.id = pl.id_dosen
                WHERE pl.id_dosen = $1
                ORDER BY pl.id DESC";

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
                (id_dosen, judul, deskripsi, status)
                VALUES ($1,$2,$3,$4)";

        return pg_query_params($this->db, $sql, $params);
    }

    public function updateData($id, $params)
    {
        $sql = "UPDATE {$this->table}
                SET id_dosen=$1,
                    judul=$2,
                    deskripsi=$3,
                    status=$4
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
