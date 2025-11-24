<?php

class Users extends Model
{
    protected $table = 'users';

    private function validRole($role)
    {
        return in_array($role, ['admin','editor'], true);
    }

    public function findByUsername($username)
    {
        $sql = "SELECT * FROM {$this->table} WHERE username=$1 LIMIT 1";
        $res = pg_query_params($this->db, $sql, [$username]);
        return $res ? pg_fetch_assoc($res) : null;
    }

    public function getAllUsers()
    {
        $sql = "SELECT * FROM {$this->table} ORDER BY id DESC";
        return pg_query($this->db, $sql);
    }

    public function getById($id)
    {
        $sql = "SELECT * FROM {$this->table} WHERE id=$1 LIMIT 1";
        $res = pg_query_params($this->db, $sql, [$id]);
        return $res ? pg_fetch_assoc($res) : null;
    }

    public function create($data)
{
    $role = $this->validRole($data['role']) ? $data['role'] : 'editor';
    $idDosen = $data['id_dosen'] ?? null;

    $sql = "INSERT INTO {$this->table} (username, password, role, id_dosen)
            VALUES ($1, $2, $3, $4)";

    return pg_query_params($this->db, $sql, [
        $data['username'],
        $data['password'],
        $role,
        $idDosen
    ]);
}


    public function updateUserNoPass($id, $username, $role, $idDosen = null)
    {
        if (!$this->validRole($role)) $role = 'editor';
        $sql = "UPDATE {$this->table} SET username=$1, role=$2, id_dosen=$3 WHERE id=$4";
        return pg_query_params($this->db, $sql, [$username, $role, $idDosen, $id]);
    }

    public function updateUser($id, $username, $password, $role, $idDosen = null)
    {
        if (!$this->validRole($role)) $role = 'editor';
        $sql = "UPDATE {$this->table} SET username=$1, password=$2, role=$3, id_dosen=$4 WHERE id=$5";
        return pg_query_params($this->db, $sql, [$username, $password, $role, $idDosen, $id]);
    }

    public function deleteUser($id)
    {
        return pg_query_params($this->db, "DELETE FROM {$this->table} WHERE id=$1", [$id]);
    }


    public function countEditors()
    {
        $sql = "SELECT COUNT(*) AS total FROM {$this->table} WHERE role = $1";
        $res = pg_query_params($this->db, $sql, ['editor']);
        if ($res === false) return 0;
        $row = pg_fetch_assoc($res);
        return $row ? intval($row['total']) : 0;
    }
}
