<?php

class ProductModel extends Model
{
    private $conn;

    public function __construct(){
        $this->conn = Database::connect();
    }

   public function fetchProduct(){
    $sql = "SELECT id, nama_produk, deskripsi, kategori, link_demo, image 
            FROM produk 
            ORDER BY id DESC 
            LIMIT 3";

    $result = pg_query($this->conn, $sql);

    if (!$result) {
        die("SQL ERROR: " . pg_last_error($this->conn));
    }

    $data = [];
    while ($row = pg_fetch_assoc($result)) {
        $data[] = $row;
    }

    return $data;
}


}