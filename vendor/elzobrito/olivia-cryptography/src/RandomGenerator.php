<?php
namespace OliviaCryptography;

interface RandomGenerator
{
    public function getRandomBytes(int $length): string;
}
