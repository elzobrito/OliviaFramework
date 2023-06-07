<?php

namespace OliviaCryptography;

class AESEncrypt extends AES256Encryption implements Encryption
{
    public function encrypt($q, $secret_key, $secret_iv): string
    {
        return $this->encrypt_decrypt('encrypt', $q, $secret_key, $secret_iv);
    }
}
