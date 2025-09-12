<?php
session_start();
require __DIR__ . '/sso_client.php';

$_SESSION = [];
session_destroy();

$_SESSION['flash_success'] = 'Anda telah logout.';
header('Location: ' . app_base_url('index.php'));
exit;
