<?php
class Middleware
{
    public static function auth()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: /admin/login');
            exit;
        }
    }

    public static function onlyAdmin()
    {
        self::auth();
        if ($_SESSION['user']['role'] !== 'admin') {
            die("Akses ditolak! Halaman ini khusus Admin.");
        }
    }

    public static function onlyEditor()
    {
        self::auth();
        if ($_SESSION['user']['role'] !== 'editor') {
            die("Akses ditolak! Halaman ini khusus Editor.");
        }
    }
}
