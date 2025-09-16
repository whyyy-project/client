<?php
/**
 * Callback Handler untuk SSO
 * 
 * File ini menangani respons dari server SSO setelah proses otorisasi.
 * Bertanggung jawab untuk menukar authorization code dengan access token
 * dan menyimpan informasi user ke dalam session.
 */

// Mulai session untuk menyimpan state login
session_start();

// Include file helper SSO
require __DIR__ . '/sso_client.php';

// Validasi parameter code dan state dari URL callback
// Parameter ini dikirim oleh server SSO setelah user menyetujui permintaan otorisasi
$code  = $_GET['code']  ?? null;  // Authorization code untuk ditukar dengan access token
$state = $_GET['state'] ?? null;  // Parameter state untuk mencegah CSRF
// Pastikan kedua parameter ada
if (!$code || !$state) {
    $_SESSION['flash_error'] = 'Kode otorisasi atau state tidak ditemukan.';
    header('Location: ' . app_base_url('index.php'));
    exit;
}

// Validasi state untuk mencegah serangan CSRF
// Bandingkan state yang diterima dengan yang disimpan di session
if (empty($_SESSION['oauth_state']) || !hash_equals($_SESSION['oauth_state'], $state)) {
    $_SESSION['flash_error'] = 'State tidak valid. Mungkin terjadi percobaan serangan CSRF atau session sudah kadaluarsa.';
    header('Location: ' . app_base_url('index.php'));
    exit;
}

// Hapus state dari session karena sudah digunakan (one-time use)
unset($_SESSION['oauth_state']);

try {
    // 1. Tukar authorization code dengan access token
    $token = sso_exchange_code($code);
    
    // Pastikan access token ada dalam respons
    $accessToken = $token['access_token'] ?? null;
    if (!$accessToken) {
        throw new RuntimeException('Access token kosong. Server tidak mengembalikan token akses.');
    }
    
    // 2. Dapatkan informasi user menggunakan access token
    $me = sso_me($accessToken);
header('Content-Type: application/json');
echo json_encode($me, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
exit;

    // 3. Simpan informasi login ke dalam session
    $_SESSION['isLoggedIn']   = true;           // Flag status login
    $_SESSION['access_token'] = $accessToken;    // Token akses untuk permintaan API selanjutnya
    $_SESSION['user']         = $me;             // Data user (id, name, email, role, dll)

    // 4. Redirect ke halaman dashboard setelah login berhasil
    header('Location: ' . app_base_url('dashboard.php'));
    exit;
} catch (Throwable $e) {
    // Tangani error yang terjadi selama proses login
    // Simpan pesan error ke dalam session untuk ditampilkan ke user
    $_SESSION['flash_error'] = 'Login SSO gagal: ' . $e->getMessage();
    
    // Catat error ke log server untuk keperluan debugging
    error_log('SSO Login Error: ' . $e->getMessage());
    
    // Redirect kembali ke halaman login dengan pesan error
    header('Location: ' . app_base_url('index.php'));
    exit;
}
