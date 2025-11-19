<?php
// Basic PHP SSO Client Configuration

return [
    // Base URL of this client app (with trailing slash)
    // Example for Laragon default Apache on 8080
    'app_base_url' => 'http://localhost/client/php_basic/',

    // SSO server base URL (no trailing slash)
    'sso_base_url' => 'https://sso.whyyyproject.my.id/',

    // Client credentials registered at SSO
    'client_id' => '25f78a1a-a142-4a78-bf44-bb37ba74a3ba',
    'client_secret' => '2tWPdYChTFGGmzOfLEDEKkYCYuBsTCymeo9slI4lyek7EXke',

    // Redirect URI must exactly match the one registered at SSO
    'redirect_uri' => 'http://localhost/client/php_basic/callback.php',
];
