<?php

namespace OliviaCryptography;

interface Decryption
{
    public function decrypt($q, $secret_key, $secret_iv): string;
}