<?php

namespace OliviaFrameApp\Controller;

use OliviaFrameApp\Abstracts\AbstractController;
use OliviaFramePublico\E404;
use OliviaFramePublico\Home\Index;
use OliviaRouter\Trie;

class HomeController extends AbstractController
{
    public function index()
    {
        $parametros = $this->config_controller();
        new Index($parametros);
    }

    public function abrir()
    {
        print_R($_REQUEST);
    }
    public function error404()
    {
        $parametros = $this->config_controller();
        new E404($parametros);
    }
}
