<?php

require_once __DIR__ . "/../../../config/Database.php";

class PublicationModel
{
    private $conn;

    public function __construct()
    {
        $this->conn = Database::connect();
    }

    public function getAll()
    {
        $sql = "
            SELECT id, judul, deskripsi, file_dokumen, kategori
            FROM publikasi_lab
            ORDER BY id DESC
            LIMIT 3
        ";

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