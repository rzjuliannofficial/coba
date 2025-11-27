<?php

class Dosen extends Model
{
    protected $table = 'dosen';



    public function getAll()
    {
        $res = pg_query($this->db, "SELECT * FROM {$this->table} ORDER BY nama ASC");
        $rows = [];
        while ($row = pg_fetch_assoc($res)) {
            $rows[] = $row;
        }
        return $rows;
    }

    public function find($id)
    {
        $res = pg_query_params($this->db, "SELECT * FROM {$this->table} WHERE id=$1", [$id]);
        return $res ? pg_fetch_assoc($res) : null;
    }

    public function create($data)
    {
        $sql = "INSERT INTO {$this->table} 
            (nama, nip, email, foto_profil, keahlian_text, deskripsi, jabatan) 
            VALUES ($1,$2,$3,$4,$5,$6,$7)";

        return pg_query_params($this->db, $sql, [
            $data['nama'],
            $data['nip'],
            $data['email'],
            $data['foto'],
            $data['keahlian_text'] ?? null,
            $data['deskripsi'] ?? null,
            $data['jabatan'] ?? 'member'
        ]);
    }
    public function updateDosen($id, $data)
    {
        if (!empty($data['foto'])) {
            $sql = "UPDATE {$this->table} SET nama=$1, nip=$2, email=$3, foto_profil=$4, keahlian_text=$5, deskripsi=$6, jabatan=$7 WHERE id=$8";
            $params = [$data['nama'], $data['nip'] , $data['email'], $data['foto'], $data['keahlian_text'], $data['deskripsi'], $data['jabatan'], $id];
        } else {
            $sql = "UPDATE {$this->table} SET nama=$1, nip=$2, email=$3, keahlian_text=$4, deskripsi=$5, jabatan=$6 WHERE id=$7";
            $params = [$data['nama'], $data['nip'], $data['email'], $data['keahlian_text'], $data['deskripsi'], $data['jabatan'], $id];
        }

        return pg_query_params($this->db, $sql, $params);
    }

    public function delete($id)
    {
        return pg_query_params($this->db, "DELETE FROM {$this->table} WHERE id=$1", [$id]);
    }

    public function countAll()
    {
        $sql = "SELECT COUNT(id) AS total FROM {$this->table}";
        $res = pg_query($this->db, $sql);
        if ($res !== false) {
            $row = pg_fetch_assoc($res);
            return (int) $row['total'];
        }
        return 0;
    }
}
