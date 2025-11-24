<?php

class Produk extends Model
{
    protected $table = "produk";

    public function getAll()
    {
        $sql = "SELECT * FROM {$this->table} ORDER BY id DESC";
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

    public function create($params)
    {
        $sql = "INSERT INTO {$this->table}
                (nama_produk, deskripsi, link_demo, image, kategori)
                VALUES ($1,$2,$3,$4,$5)";

        return pg_query_params($this->db, $sql, $params);
    }

    public function createAndReturnId($params)
{
    $sql = "INSERT INTO {$this->table}
            (nama_produk, deskripsi, link_demo, image, kategori)
            VALUES ($1,$2,$3,$4,$5)
            RETURNING id";

    $res = pg_query_params($this->db, $sql, $params);
    $row = pg_fetch_assoc($res);
    return $row['id'];
}


    public function updateData($id, $params)
    {
        $sql = "UPDATE {$this->table}
                SET nama_produk=$1,
                    deskripsi=$2,
                    link_demo=$3,
                    image=$4,
                    kategori=$5
                WHERE id=$6";

        return pg_query_params($this->db, $sql, [
            $params[0], $params[1], $params[2],
            $params[3], $params[4], $id
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
