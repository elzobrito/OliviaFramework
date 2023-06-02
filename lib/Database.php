<?php

namespace OliviaFrameLib;

use OliviaDatabaseLibrary\ADatabase;

class Database extends ADatabase
{
    //put your code here
    public static function getDB($name = null)
    {
        $db = null;
        switch ($name) {
            default:
                $db = [
                    'host' => '127.0.0.1',
                    'port' => '',
                    'database' => 'votacao_cps',
                    'user' => 'root',
                    'password' => '',
                    'driver' => 'mysql'
                ];
                break;
        }
        return $db;
    }
}
