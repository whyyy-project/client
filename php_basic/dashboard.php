<?php
session_start();
require __DIR__ . '/sso_client.php';

if (empty($_SESSION['isLoggedIn'])) {
    $_SESSION['flash_error'] = 'Silakan login terlebih dahulu.';
    header('Location: ' . app_base_url('index.php'));
    exit;
}

$user = $_SESSION['user'] ?? [];
$role = $user['role'] ?? ($user['roles'][0] ?? 'mahasiswa');

?><!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Dashboard - PHP Basic SSO</title>
  <style>
    body{font-family:system-ui,Segoe UI,Roboto,Helvetica,Arial,sans-serif;background:#f5f7fb;margin:0}
    .container{max-width:980px;margin:32px auto;padding:24px}
    .card{background:#fff;border-radius:16px;box-shadow:0 10px 30px rgba(0,0,0,.08);padding:24px}
    .badge{display:inline-block;padding:6px 10px;border-radius:999px;background:#e2e8f0}
    .btn{display:inline-block;background:#64748b;color:#fff;border-radius:999px;padding:10px 14px;text-decoration:none}
  </style>
</head>
<body>
<div class="container">
  <div class="card">
    <h2>Dashboard (<?php echo htmlspecialchars(strtoupper($role)); ?>)</h2>
    <p>Halo, <strong><?php echo htmlspecialchars($user['name'] ?? ''); ?></strong></p>
    <p>Email: <?php echo htmlspecialchars($user['email'] ?? ''); ?></p>
    <p>Role: <span class="badge"><?php echo htmlspecialchars($role); ?></span></p>

    <?php if ($role === 'pegawai'): ?>
      <h3>Menu Pegawai</h3>
      <ul>
        <li>Rekap Presensi</li>
        <li>Pengajuan Cuti</li>
      </ul>
    <?php elseif ($role === 'dosen'): ?>
      <h3>Menu Dosen</h3>
      <ul>
        <li>RPS & Nilai</li>
        <li>Jadwal Mengajar</li>
      </ul>
    <?php else: ?>
      <h3>Menu Mahasiswa</h3>
      <ul>
        <li>KRS & KHS</li>
        <li>Jadwal Kuliah</li>
      </ul>
    <?php endif; ?>

    <p style="margin-top:16px"><a class="btn" href="<?php echo app_base_url('logout.php'); ?>">Logout</a></p>
  </div>
</div>
</body>
</html>
