<?php

namespace OliviaFrameLib;

use OliviaRouter\Router;

class Route
{
    public function execute()
    {
        $router = new Router();

        //GET
        $router->get('/', 'HomeController#index');
        $router->get('/error404', 'HomeController#error404');

        $router->execute($_SERVER);

        if ($_SESSION['e404'])
            header('Location: http://' . $_SERVER['HTTP_HOST'] . DIRECTORY_SEPARATOR . $_SESSION['BASENAME'] . DIRECTORY_SEPARATOR . 'error404');
    }



    private function execute_action_get($router, $middleware, $controller, $url_value_get)
    {
        foreach ($url_value_get as $key => $url) {
            $url_explode = explode('/', $url);
            $router->middleware($middleware)->get($url, $controller . '#' . str_replace('{:param}', '', implode('_', explode('-',  $url_explode[count($url_explode) - 1]))));
        }
    }

    private function execute_action_post($router, $middleware, $controller, $url_value_post)
    {
        foreach ($url_value_post as $key => $url) {
            $url_explode = explode('/', $url);
            $router->middleware($middleware)->post($url, $controller . '#' . implode('_', explode('-',  $url_explode[count($url_explode) - 1])));
        }
    }
}
