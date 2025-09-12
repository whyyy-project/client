<?php

namespace App\Controllers;
use CodeIgniter\HTTP\ResponseInterface;
class DashboardController extends BaseController
{
    public function index(): ResponseInterface|string
    {
        $user = session('user');
        if (!$user) {
            return redirect()->to('/')->with('error', 'Silakan login dahulu.');
        }
        dd($user);

        // Deteksi role dari payload /me (sesuaikan jika SSO Anda berbeda)
        $role = $user['role'] ?? ($user['roles'][0] ?? 'mahasiswa');

        if ($role === 'pegawai') {
            return view('dashboard/pegawai', ['user' => $user]);
        }
        if ($role === 'dosen') {
            return view('dashboard/dosen', ['user' => $user]);
        }
        // default mahasiswa
        return view('dashboard/mahasiswa', ['user' => $user]);
    }
}
