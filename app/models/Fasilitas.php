<?php

class Fasilitas extends Model
{
    protected $table = "fasilitas";
    protected $primaryKey = "id_fasilitas";

    public function getAll()
    {
        $sql = "SELECT * FROM {$this->table} ORDER BY id_fasilitas DESC";
        $res = pg_query($this->db, $sql);

        $rows = [];
        while ($row = pg_fetch_assoc($res)) $rows[] = $row;
        return $rows;
    }

    public function find($id)
    {
        $sql = "SELECT * FROM {$this->table} WHERE id_fasilitas=$1";
        $res = pg_query_params($this->db, $sql, [$id]);

        return $res ? pg_fetch_assoc($res) : null;
    }

    public function create($params)
    {
        $sql = "INSERT INTO {$this->table}
                (nama_fasilitas, deskripsi, kondisi, foto)
                VALUES ($1,$2,$3,$4)";

        return pg_query_params($this->db, $sql, $params);
    }

    public function createAndReturnId($params)
{
    $sql = "INSERT INTO {$this->table}
            (nama_fasilitas, deskripsi, kondisi, foto)
            VALUES ($1,$2,$3,$4)
            RETURNING id_fasilitas";

    $res = pg_query_params($this->db, $sql, $params);
    $row = pg_fetch_assoc($res);
    return $row['id_fasilitas'];
}


    public function updateData($id, $params)
    {
        $sql = "UPDATE {$this->table}
                SET nama_fasilitas=$1,
                    deskripsi=$2,
                    kondisi=$3,
                    foto=$4
                WHERE id_fasilitas=$5";

        return pg_query_params($this->db, $sql, [
            $params[0], $params[1], $params[2], $params[3], $id
        ]);
    }

    public function delete($id)
    {
        return pg_query_params(
            $this->db,
            "DELETE FROM {$this->table} WHERE id_fasilitas=$1",
            [$id]
        );
    }
}
