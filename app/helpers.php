<?php

// Encryption
if (!function_exists('encrypt_string')) {
    function encrypt_string($value)
    {
        $encrypted = openssl_encrypt($value, 'AES-128-ECB', 'epikm');
        return base64_encode($encrypted);
    }
}

// Decryption
if (!function_exists('decrypt_string')) {
    function decrypt_string($encryptedValue)
    {
        $decoded = base64_decode($encryptedValue);
        $decrypted = openssl_decrypt($decoded, 'AES-128-ECB', 'epikm');
        return $decrypted;
    }
}

//number format
if (!function_exists('formatNumberShort')) {
    function formatNumberShort($number, $precision = 1)
    {
        if ($number < 1000) {
            return number_format($number, 2);
        } elseif ($number < 1000000) {
            return round($number / 1000, $precision) . 'k';
        } elseif ($number < 1000000000) {
            return round($number / 1000000, $precision) . 'm';
        } else {
            return round($number / 1000000000, $precision) . 'b';
        }
    }
}
