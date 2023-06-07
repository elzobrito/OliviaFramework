<?php

namespace OliviaFrameApp\Controller;

use OliviaFrameApp\Abstracts\AbstractController;
use OliviaFramePublico\E404;
use OliviaFramePublico\Home\Index;

class HomeController extends AbstractController
{
    public function index()
    {
        $parametros = $this->config_controller();
        new Index($parametros);
    }

    public function error404()
    {
        $parametros = $this->config_controller();
        new E404($parametros);
    }
}
