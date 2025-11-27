<?php

class Database
{
    private static $conn;

    public static function connect()
    {
        if (!self::$conn) {

            $host = "localhost";
            $user = "postgres";
            $pass = "123";
            $dbname = "Ai_database";
            self::$conn = pg_connect("host=$host port=5432 dbname=$dbname user=$user password=$pass");

            if (!self::$conn) {
                die("Gagal connect ke PostgreSQL");
            }
        }

        return self::$conn;
    }
}
