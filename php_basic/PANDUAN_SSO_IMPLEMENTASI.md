# Panduan Implementasi SSO Client PHP

## Daftar Isi
1. [Pendahuluan](#pendahuluan)
2. [Persyaratan Sistem](#persyaratan-sistem)
3. [Struktur File](#struktur-file)
4. [Konfigurasi](#konfigurasi)
5. [Alur Kerja SSO](#alur-kerja-sso)
6. [Penjelasan Kode](#penjelasan-kode)
7. [Pengujian](#pengujian)
8. [Pemecahan Masalah](#pemecahan-masalah)

## Pendahuluan
Dokumen ini menjelaskan implementasi Single Sign-On (SSO) menggunakan protokol OAuth 2.0 dengan grant type Authorization Code. Implementasi ini memungkinkan pengguna untuk login sekali dan mengakses beberapa aplikasi yang terhubung.

## Persyaratan Sistem
- PHP 7.4 atau lebih baru
- Ekstensi PHP: cURL (direkomendasikan) atau allow_url_fopen diaktifkan
- Web server (Apache/Nginx)
- Akses ke server SSO

## Struktur File
```
php_basic/
├── callback.php    # Menangani respons dari server SSO
├── config.php      # Konfigurasi koneksi SSO
├── dashboard.php   # Halaman setelah login berhasil
├── index.php       # Halaman login
├── logout.php      # Proses logout
└── sso_client.php  # Library helper untuk SSO
```

## Konfigurasi
File `config.php` berisi konfigurasi yang diperlukan:

```php
return [
    // URL dasar aplikasi client (dengan trailing slash)
    'app_base_url' => 'http://localhost/client/php_basic/',
    
    // URL server SSO (tanpa trailing slash)
    'sso_base_url' => 'http://127.0.0.1:8000',
    
    // Kredensial client yang didaftarkan di SSO
    'client_id' => '3afec1b7-f651-4304-94f7-e9dee7954834',
    'client_secret' => 'zytKYtECxzeDmihLtAFUjM46T5P4E5TkpW4rmKEtA8cOqxFo',
    
    // Redirect URI harus sama persis dengan yang didaftarkan di SSO
    'redirect_uri' => 'http://localhost/client/php_basic/callback.php',
];
```

## Alur Kerja SSO

1. **Inisiasi Login**
   - Pengguna mengakses halaman login
   - Aplikasi mengarahkan ke halaman otorisasi SSO dengan parameter yang diperlukan

2. **Otorisasi**
   - Pengguna login dan menyetujui permintaan akses
   - Server SSO mengembalikan authorization code ke callback URL

3. **Pertukaran Token**
   - Aplikasi menukar authorization code dengan access token
   - Server SSO memvalidasi code dan mengembalikan access token

4. **Mengambil Data Pengguna**
   - Aplikasi menggunakan access token untuk mengambil data pengguna
   - Server SSO memvalidasi token dan mengembalikan data pengguna

5. **Session Management**
   - Aplikasi membuat session untuk pengguna
   - Pengguna diarahkan ke halaman dashboard

## Penjelasan Kode

### sso_client.php

#### Fungsi Utama

1. **sso_build_authorize_url()**
   - Membangun URL untuk mengarahkan pengguna ke halaman login SSO
   - Menghasilkan state acak untuk keamanan (CSRF protection)

2. **sso_exchange_code()**
   - Menukar authorization code dengan access token
   - Mengirim permintaan ke endpoint `/api/token`
   - Mengembalikan access token dan refresh token

3. **sso_me()**
   - Mengambil informasi pengguna menggunakan access token
   - Mengirim permintaan ke endpoint `/api/me`
   - Mengembalikan data profil pengguna

### callback.php

- Memvalidasi state untuk mencegah serangan CSRF
- Menukar authorization code dengan access token
- Mengambil data pengguna
- Membuat session untuk pengguna
- Mengarahkan ke halaman dashboard atau menampilkan pesan error

## Pengujian

1. Pastikan server SSO berjalan di `http://127.0.0.1:8000`
2. Buka `http://localhost/client/php_basic/` di browser
3. Klik tombol login
4. Masuk dengan kredensial yang valid
5. Pastikan diarahkan ke halaman dashboard setelah login berhasil

## Pemecahan Masalah

### Error: "State tidak valid"
- Pastikan session berfungsi dengan baik
- Periksa apakah cookies diaktifkan di browser

### Error: "Access token kosong"
- Periksa koneksi ke server SSO
- Pastikan client_id dan client_secret benar
- Verifikasi redirect_uri sesuai dengan yang didaftarkan

### Error: "Fetch /me failed"
- Periksa apakah access token valid
- Pastikan endpoint `/api/me` tersedia di server SSO
- Periksa log server untuk detail error lebih lanjut

## Keamanan

1. Selalu gunakan HTTPS di lingkungan produksi
2. Simpan client_secret dengan aman (jangan commit ke repository publik)
3. Validasi semua input pengguna
4. Gunakan state parameter untuk mencegah CSRF
5. Atur waktu kadaluarsa session yang wajar

## Kontak

Untuk bantuan lebih lanjut, hubungi tim pengembang atau buat issue di repositori proyek.
