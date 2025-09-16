<?php
// Basic PHP SSO Client Configuration

return [
    // Base URL of this client app (with trailing slash)
    // Example for Laragon default Apache on 8080
    'app_base_url' => 'http://localhost/client/php_basic/',

    // SSO server base URL (no trailing slash)
    'sso_base_url' => 'http://127.0.0.1:8000/',

    // Client credentials registered at SSO
    'client_id' => 'demo-client',
    'client_secret' => 'KE2epfA0sYTojsnW4s1e9BQhofrVHsezhn4jkySHaiiEeUIU',

    // Redirect URI must exactly match the one registered at SSO
    'redirect_uri' => 'http://localhost/client/php_basic/callback.php',
];
