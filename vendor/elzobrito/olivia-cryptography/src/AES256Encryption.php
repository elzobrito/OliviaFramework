<?php

namespace OliviaCryptography;

abstract class AES256Encryption
{
    protected function encrypt_decrypt($action, $string, $secret_key, $secret_iv)
    {
        $output = false;
        $encrypt_method = "AES-256-CBC";
        $key = hash('sha256', $secret_key);
        $iv = substr(hash('sha256', $secret_iv), 0, 16);

        switch ($action) {
            case 'encrypt': {
                    $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
                    $output = base64_encode($output);
                    break;
                }

            case 'decrypt': {
                    $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
                    break;
                }
        }

        return $output;
    }
}
