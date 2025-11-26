<?php

class PublikasiLab extends Model
{
    protected $table = "publikasi_lab";

    public function getAll()
    {
        $sql = "SELECT pl.*, d.nama AS nama_dosen
                FROM publikasi_lab pl
                LEFT JOIN dosen d ON d.id = pl.id
                ORDER BY pl.id DESC";

        $res = pg_query($this->db, $sql);
        $rows = [];
        while ($row = pg_fetch_assoc($res)) $rows[] = $row;

        return $rows;
    }

    public function getByDosen($id)
    {
        $sql = "SELECT pl.*, d.nama AS nama_dosen
                FROM publikasi_lab pl
                LEFT JOIN dosen d ON d.id = pl.id
                WHERE pl.id = $1
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
                (id, judul, deskripsi, file_dokumen, kategori)
                VALUES ($1,$2,$3,$4,$5)";

        return pg_query_params($this->db, $sql, $params);
    }

     public function createAndReturnId($params)
    {
        $sql = "INSERT INTO {$this->table}
                (id, judul, deskripsi, file_dokumen, kategori)
                VALUES ($1,$2,$3,$4,$5)
                RETURNING id";

        $res = pg_query_params($this->db, $sql, $params);
        $row = pg_fetch_assoc($res);
        return $row['id'];
    }

public function updateLab($id, $params)
{
    $sql = "UPDATE {$this->table}
            SET id=$1,
                judul=$2,
                deskripsi=$3,
                file_dokumen=$4,
                kategori=$5
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
