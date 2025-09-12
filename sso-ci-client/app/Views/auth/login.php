<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Login - SSO UNUGIRI Client</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
  <style>
    body{font-family:Inter, system-ui, -apple-system, Segoe UI, Roboto, Helvetica, Arial, sans-serif;background:#f7fafc;margin:0}
    .container{max-width:720px;margin:64px auto;padding:24px}
    .card{background:#fff;border-radius:16px;box-shadow:0 10px 30px rgba(0,0,0,.08);padding:32px}
    .btn{display:inline-flex;align-items:center;gap:10px;background:#2563eb;color:#fff;border:none;border-radius:999px;padding:12px 18px;font-weight:600;text-decoration:none}
    .btn:hover{background:#1d4ed8}
    .msg{margin-bottom:16px;color:#dc2626}
  </style>
</head>
<body>
  <div class="container">
    <div class="card">
      <h2>SSO UNUGIRI Client</h2>
      <?php if (session('error')): ?>
        <div class="msg"><?= esc(session('error')) ?></div>
      <?php endif; ?>
      <?php if (session('success')): ?>
        <div class="msg" style="color:#16a34a;"><?= esc(session('success')) ?></div>
      <?php endif; ?>

      <p>Silakan login menggunakan akun SSO UNUGIRI.</p>
      <p>
        <a class="btn" href="<?= esc($authorizeUrl) ?>">
          <img src="https://unugiri.ac.id/wp-content/uploads/2021/07/cropped-logo-unugiri.png" width="18" height="18" alt=""/>
          Login dengan SSO UNUGIRI
        </a>
      </p>
    </div>
  </div>
</body>
</html>
