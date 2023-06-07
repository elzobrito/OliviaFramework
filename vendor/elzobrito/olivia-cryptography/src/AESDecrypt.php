<?php

namespace OliviaCryptography;

class AESDecrypt extends AES256Encryption implements Decryption
{
    public function decrypt($q, $secret_key, $secret_iv): string
    {
        return $this->encrypt_decrypt('decrypt', $q, $secret_key, $secret_iv);
    }
}
