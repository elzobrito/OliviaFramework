<?php

namespace OliviaFrameLib;

ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);

ini_set('memory_limit', '-1');

ini_set('session.cache_expire', 60); // tempo de sessão aberta 60 minutos.
ini_set('session.cookie_httponly', true);
ini_set('session.cookie_secure', true);
session_start();

setlocale(LC_MONETARY, 'pt_BR');

//Contante de configuração do CSRF ao deixar true todos os post são verificados
use OliviaUuid\uuid\RandomUUIDGenerator;
use OliviaUuid\uuid\UUIDService;

class Config
{
    public function __construct()
    {
        $_SESSION['e404'] = false;
        $_SESSION['CSRF'] = true;
        $_SESSION['App_folder'] = 'OliviaFrameApp';
        $_SESSION['Middleware_folder'] = 'Middleware';
        $_SESSION['Controller_folder'] = 'Controller';
        $_SESSION['BASENAME'] = explode('/', $_SERVER["REQUEST_URI"])[1];
        
        $generator = new RandomUUIDGenerator();
        $service = new UUIDService($generator);

        if (!isset($_SESSION['UUID'])) {
            $_SESSION['UUID'] = $service->generateUUID();
            $_SESSION['CSRF_FIELD'] = '<input type="hidden" name="_token" value="' . $_SESSION['UUID'] . '">';
        }

        if (!isset($_SESSION['secret_key'])) {
            $_SESSION['secret_key'] = $service->generateUUID();
        }

        if (!isset($_SESSION['secret_iv'])) {
            $_SESSION['secret_iv'] = $service->generateUUID();
        }
    }
}
