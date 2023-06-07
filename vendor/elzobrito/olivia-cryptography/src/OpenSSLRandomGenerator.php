<?php

namespace OliviaCryptography;

class OpenSSLRandomGenerator implements RandomGenerator
{
    public function getRandomBytes(int $length): string
    {
        return openssl_random_pseudo_bytes($length);
    }
}
