<?php

class Model
{
    protected $db;

    public function __construct()
    {
        $this->db = Database::connect(); // ini adalah resource pgsql
    }
}
