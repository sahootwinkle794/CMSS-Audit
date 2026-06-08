<?php
$password = 'Cm5s@2026#';  // Staging DB password
$key      = 'cmss_new-secret-key-026';   // Same secret key

$encrypted = base64_encode(openssl_encrypt(
    $password,
    'AES-256-CBC',
    $key,
    0,
    substr($key, 0, 16)
));

echo $encrypted;
?>