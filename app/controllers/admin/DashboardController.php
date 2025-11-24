<?php

class DashboardController extends Controller
{
    public function index()
    {
        // Load Model
        $dosenModel = new dosen();
        $userModel = new Users();

        // Ambil statistik
        $totalDosen = $dosenModel->countAll();
        $totalUser = $userModel->countEditors();
        $totalPublikasi = 0; // Nanti kalau tabel publikasi sudah ada, tinggal tambahkan model-nya.
        $totalGaleri = 0;

        // Kirim ke view
        $this->view('admin/dashboard/Dashboard', [
            'totalDosen' => $totalDosen,
            'totalUser'  => $totalUser,
            'totalPublikasi' => $totalPublikasi,
            'totalGaleri' => $totalGaleri
        ]);
    }
}
