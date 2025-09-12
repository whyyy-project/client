<?php
/**
 * SSO Client Helper
 * 
 * File ini berisi fungsi-fungsi untuk menangani proses Single Sign-On (SSO)
 * menggunakan protokol OAuth 2.0 dengan grant type authorization code.
 * Mendukung fallback ke file_get_contents jika ekstensi curl tidak tersedia.
 */

/**
 * Mengambil konfigurasi dari file config.php
 * 
 * @return array Konfigurasi aplikasi
 */
function cfg(): array {
    static $cfg;
    if (!$cfg) {
        $cfg = require __DIR__ . '/config.php';
    }
    return $cfg;
}

/**
 * Membangun URL lengkap untuk aplikasi
 * 
 * @param string $path Path relatif yang akan ditambahkan ke base URL
 * @return string URL lengkap
 */
function app_base_url(string $path = ''): string {
    $base = rtrim(cfg()['app_base_url'], '/');
    $path = ltrim($path, '/');
    return $base . '/' . $path;
}

/**
 * Membangun URL untuk proses otorisasi SSO
 * 
 * @param array $extra Parameter tambahan yang akan dimasukkan ke dalam query string
 * @return string URL lengkap untuk proses otorisasi
 */
function sso_build_authorize_url(array $extra = []): string {
    $cfg = cfg();
    $query = array_merge([
        'client_id' => $cfg['client_id'],
        'redirect_uri' => $cfg['redirect_uri'],
        'response_type' => 'code',
        'state' => bin2hex(random_bytes(16)), // CSRF protection
    ], $extra);
    
    // Format URL: {sso_base_url}/auth?client_id=...&redirect_uri=...&response_type=...&state=...
    return rtrim($cfg['sso_base_url'], '/') . '/auth?' . http_build_query($query);
}

/**
 * Mengirim permintaan HTTP POST dengan form data
 * 
 * @param string $url URL target
 * @param array $form Data form yang akan dikirim
 * @return array [status_code, error_message, response_body]
 */
function http_post_form(string $url, array $form): array {
    if (function_exists('curl_init')) {
        $ch = curl_init($url);
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => http_build_query($form),
            CURLOPT_HTTPHEADER => ['Accept: application/json'],
            CURLOPT_TIMEOUT => 15,
        ]);
        $body = curl_exec($ch);
        $err = curl_error($ch);
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        return [$code, $err, $body];
    }
    // Fallback without cURL
    $opts = [
        'http' => [
            'method'  => 'POST',
            'header'  => "Content-Type: application/x-www-form-urlencoded\r\nAccept: application/json\r\n",
            'content' => http_build_query($form),
            'timeout' => 15,
        ],
    ];
    $context = stream_context_create($opts);
    $body = @file_get_contents($url, false, $context);
    $code = 0; $err = '';
    if (isset($http_response_header) && is_array($http_response_header)) {
        foreach ($http_response_header as $h) {
            if (preg_match('#^HTTP/\S+\s+(\d+)#', $h, $m)) { $code = (int) $m[1]; break; }
        }
    }
    if ($body === false) { $err = 'HTTP request failed'; }
    return [$code, $err, $body ?: ''];
}

/**
 * Mengirim permintaan HTTP GET dan mengharapkan respons JSON
 * 
 * @param string $url URL target
 * @param array $headers Header tambahan untuk request
 * @return array [status_code, error_message, response_body]
 */
function http_get_json(string $url, array $headers = []): array {
    $headers = array_merge(['Accept: application/json'], $headers);
    if (function_exists('curl_init')) {
        $ch = curl_init($url);
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => $headers,
            CURLOPT_TIMEOUT => 15,
        ]);
        $body = curl_exec($ch);
        $err = curl_error($ch);
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        return [$code, $err, $body];
    }
    // Fallback without cURL
    $headerStr = implode("\r\n", $headers);
    $opts = [
        'http' => [
            'method'  => 'GET',
            'header'  => $headerStr . "\r\n",
            'timeout' => 15,
        ],
    ];
    $context = stream_context_create($opts);
    $body = @file_get_contents($url, false, $context);
    $code = 0; $err = '';
    if (isset($http_response_header) && is_array($http_response_header)) {
        foreach ($http_response_header as $h) {
            if (preg_match('#^HTTP/\S+\s+(\d+)#', $h, $m)) { $code = (int) $m[1]; break; }
        }
    }
    if ($body === false) { $err = 'HTTP request failed'; }
    return [$code, $err, $body ?: ''];
}

/**
 * Menukar authorization code dengan access token
 * 
 * @param string $code Authorization code dari SSO server
 * @return array Respons dari server berisi token akses
 * @throws RuntimeException Jika terjadi kesalahan saat pertukaran token
 */
function sso_exchange_code(string $code): array {
    $cfg = cfg();
    $url = rtrim($cfg['sso_base_url'], '/') . '/api/token';
    [$status, $err, $body] = http_post_form($url, [
        'grant_type' => 'authorization_code',
        'client_id' => $cfg['client_id'],
        'client_secret' => $cfg['client_secret'],
        'redirect_uri' => $cfg['redirect_uri'],
        'code' => $code,
    ]);
    if ($err) {
        throw new RuntimeException('HTTP error: ' . $err);
    }
    $json = json_decode($body, true) ?: [];
    if ($status >= 400) {
        $msg = $json['message'] ?? $json['error'] ?? ('HTTP ' . $status);
        throw new RuntimeException('Token exchange failed: ' . $msg);
    }
    return $json;
}

/**
 * Mendapatkan informasi user menggunakan access token
 * 
 * @param string $accessToken Token akses yang didapat dari sso_exchange_code()
 * @return array Data profil user
 * @throws RuntimeException Jika gagal mengambil data user
 */
function sso_me(string $accessToken): array {
    $cfg = cfg();
    $url = rtrim($cfg['sso_base_url'], '/') . '/api/me';
    [$status, $err, $body] = http_get_json($url, [
        'Authorization: Bearer ' . $accessToken,
    ]);
    if ($err) {
        throw new RuntimeException('HTTP error: ' . $err);
    }
    $json = json_decode($body, true) ?: [];
    if ($status >= 400) {
        $msg = $json['message'] ?? $json['error'] ?? ('HTTP ' . $status);
        throw new RuntimeException('Fetch /me failed: ' . $msg);
    }
    return $json;
}
