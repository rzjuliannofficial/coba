<?php

class MemberModel extends Model
{
    private $conn;

    public function __construct()
    {
        $this->conn = Database::connect();
    }

    public function fetchTeam() {

        $sql = "SELECT nama, nip, email, foto_profil, keahlian_text, deskripsi 
                FROM dosen 
                ORDER BY nama ASC 
                LIMIT 2";

        $result = pg_query($this->conn, $sql);

        if (!$result) {
            echo "SQL ERROR: " . pg_last_error($this->conn);
            return [];
        }

        $data = [];

        while ($row = pg_fetch_assoc($result)) {
            $data[] = $row;
        }

        return $data;
    }
}