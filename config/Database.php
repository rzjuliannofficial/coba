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
<<<<<<< HEAD
            $dbname = "Ai_database";
=======
            $dbname = "coba";
>>>>>>> d8c71d9061ec22a1215a7aa3897d25f7c382ab87

            self::$conn = pg_connect("host=$host port=5432 dbname=$dbname user=$user password=$pass");

            if (!self::$conn) {
                die("Gagal connect ke PostgreSQL");
            }
        }

        return self::$conn;
    }
}
