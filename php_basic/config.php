<?php
// Basic PHP SSO Client Configuration

// IMPORTANT: adjust these values to your environment
return [
    // Base URL of this client app (with trailing slash)
    // Example for Laragon default Apache on 8080
    'app_base_url' => 'http://localhost/client/php_basic/',

    // SSO server base URL (no trailing slash)
    'sso_base_url' => 'http://127.0.0.1:8000/',

    // Client credentials registered at SSO
    'client_id' => '3afec1b7-f651-4304-94f7-e9dee7954834',
    'client_secret' => 'zytKYtECxzeDmihLtAFUjM46T5P4E5TkpW4rmKEtA8cOqxFo',

    // Redirect URI must exactly match the one registered at SSO
    'redirect_uri' => 'http://localhost/client/php_basic/callback.php',
];
