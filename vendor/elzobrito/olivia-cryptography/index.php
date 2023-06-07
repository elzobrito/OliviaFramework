<?php

use OliviaCryptography\AESDecrypt;
use OliviaCryptography\AESEncrypt;

require_once  __DIR__ . '/vendor/autoload.php';

class index
{
    public function __construct()
    {
        $AESEncrypt = new AESEncrypt();
        $AESDecrypt = new AESDecrypt();
        $texto = 'Hello World';
        $sk = '06a28c96-89a7-45d3-99c6-fe46b6b889a9';
        $si = 'bc50cfd0-44eb-40d1-9bb3-1e9dae23e083';
        $cript = $AESEncrypt->encrypt($texto, $sk, $si);
        echo $cript . ' - ' . $AESDecrypt->decrypt($cript, $sk, $si);
    }
}
new index();
