<?php

namespace OliviaCryptography;

interface Encryption
{
    public function encrypt($q, $secret_key, $secret_iv): string;
}