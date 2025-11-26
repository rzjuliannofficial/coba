<?php

class Ppm extends Model
{
    protected $table = "ppm";

    public function getAll()
    {
        $sql = "SELECT p.*, d.nama AS nama_dosen
                FROM ppm p
                JOIN dosen d ON d.id = p.id
                ORDER BY p.id DESC";

        $res = pg_query($this->db, $sql);

        $rows = [];
        while ($row = pg_fetch_assoc($res)) $rows[] = $row;

        return $rows;
    }

    public function getByDosen($id)
    {
        $sql = "SELECT p.*, d.nama AS nama_dosen
                FROM ppm p
                JOIN dosen d ON d.id = p.id
                WHERE p.id = $1
                ORDER BY p.id DESC";

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
                (id, judul, tahun)
                VALUES ($1, $2, $3)";

        return pg_query_params($this->db, $sql, $params);
    }

    public function updatePpm($id, $params)
    {
        $sql = "UPDATE {$this->table}
                SET id=$1, judul=$2, tahun=$3
                WHERE id=$4";

        return pg_query_params($this->db, $sql, [
            $params[0], 
            $params[1],
            $params[2],
            $id
        ]);
    }

    public function delete($id)
    {
        return pg_query_params($this->db,
            "DELETE FROM {$this->table} WHERE id=$1", [$id]
        );
    }
}
