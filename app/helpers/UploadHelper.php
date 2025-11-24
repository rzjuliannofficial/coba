<?php
class UploadHelper
{
    public static function upload($inputName, $targetDir)
    {
        $namafile = $_FILES[$inputName]['name'];
        $ukuran = $_FILES[$inputName]['size'];
        $error = $_FILES[$inputName]['error'];
        $tmp_name = $_FILES[$inputName]['tmp_name'];

        if ($error === 4) {
            throw new Exception('Gambar wajib diupload');
        }

        if ($ukuran > 10000000) {
            throw new Exception('Ukuran file terlalu besar');
        }

        $ekstensiValid = ['jpg', 'jpeg', 'png', 'jfif'];
        $ekstensi = strtolower(pathinfo($namafile, PATHINFO_EXTENSION));
        if (!in_array($ekstensi, $ekstensiValid)) {
            throw new Exception('File yang diupload bukan gambar');
        }

        $namaBaru = uniqid() . '.' . $ekstensi;
        $path = $targetDir . $namaBaru;
        move_uploaded_file($tmp_name, $path);

        return $namaBaru;
    }
}
