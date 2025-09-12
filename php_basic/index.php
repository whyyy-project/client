<?php
session_start();
require __DIR__ . '/sso_client.php';

// generate state and keep in session to prevent CSRF
if (empty($_SESSION['oauth_state'])) {
    $_SESSION['oauth_state'] = bin2hex(random_bytes(16));
}
$authorizeUrl = sso_build_authorize_url(['state' => $_SESSION['oauth_state']]);
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>PHP Basic SSO Client</title>
  <style>
    body{font-family:system-ui,Segoe UI,Roboto,Helvetica,Arial,sans-serif;background:#f5f7fb;margin:0}
    .container{max-width:760px;margin:64px auto;padding:24px}
    .card{background:#fff;border-radius:16px;box-shadow:0 10px 30px rgba(0,0,0,.08);padding:32px}
    .btn{display:inline-block;background:#2563eb;color:#fff;border-radius:999px;padding:12px 18px;font-weight:600;text-decoration:none}
    .btn:hover{background:#1d4ed8}
    .msg{margin:.5rem 0;color:#dc2626}
  </style>
</head>
<body>
<div class="container">
  <div class="card">
    <h2>SSO UNUGIRI Client (PHP Basic)</h2>
    <?php if (!empty($_SESSION['flash_error'])): ?>
      <div class="msg"><?php echo htmlspecialchars($_SESSION['flash_error']); unset($_SESSION['flash_error']); ?></div>
    <?php endif; ?>
    <?php if (!empty($_SESSION['flash_success'])): ?>
      <div class="msg" style="color:#16a34a;"><?php echo htmlspecialchars($_SESSION['flash_success']); unset($_SESSION['flash_success']); ?></div>
    <?php endif; ?>

    <?php if (!empty($_SESSION['user'])): ?>
      <p>Anda sudah login sebagai <strong><?php echo htmlspecialchars($_SESSION['user']['name'] ?? ''); ?></strong>.</p>
      <p><a class="btn" href="<?php echo app_base_url('dashboard.php'); ?>">Buka Dashboard</a>
         <a class="btn" style="background:#64748b;margin-left:8px" href="<?php echo app_base_url('logout.php'); ?>">Logout</a></p>
    <?php else: ?>
      <p>Silakan login menggunakan akun SSO UNUGIRI.</p>
      <p><a class="btn" href="<?php echo htmlspecialchars($authorizeUrl); ?>">Login dengan SSO UNUGIRI</a></p>
    <?php endif; ?>
  </div>
</div>
</body>
</html>
