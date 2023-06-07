<?php

namespace OliviaFrameLib;

use OliviaRouter\Router;

class Route
{
    private $router;

    public function __construct()
    {
        $this->router = new Router();
    }

    public function execute()
    {
        // Adicione rotas aqui
        $this->router->addRoute('GET', '/home', 'HomeController#index', '');
        $this->router->addRoute('GET', '/abrir', 'HomeController#abrir', 'MidAbrir');
        $this->router->addRoute('GET', '/error404/', 'HomeController#error404','');

        $this->router->execute();
        // Redirecione para a página de erro 404 se nenhuma rota corresponder
        if ($_SESSION['e404']) {
            header('Location: http://' . $_SERVER['HTTP_HOST'] . DIRECTORY_SEPARATOR . $_SESSION['BASENAME'] . DIRECTORY_SEPARATOR . 'error404');
        }
    }
}
