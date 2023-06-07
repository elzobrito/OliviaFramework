<?php

namespace OliviaRouter;

class Router
{
    private $route;
    private $clauses;
    private $trie;

    public function __construct()
    {
        $this->route = [];
        $this->clauses = [];
        $this->trie = new Trie();
    }

    public function addRoute($httpMethod, $pattern, $handler,$middleware)
    {
        $segments = explode('/', trim($pattern, '/'));
        $this->trie->insert($segments, ['http_method' => $httpMethod, 'handler' => $handler,'middleware'=>$middleware]);
    }

    public function route($http_method, $pattern, $controller_method, $middleware)
    {
        $pattern = $this->routeToRegex('/' . $_SESSION['BASENAME'] . $pattern);
        $handler = [
            'http_method' => $http_method,
            'url_pattern' => $pattern,
            'handler' => $controller_method,
            'middleware' => $middleware
        ];

        $this->route[] = $handler;
    }

    public function execute()
    {
        $seg = null;
        $routerDispatcher = new RouterDispatcher($this->route, $this->clauses);
        $segments = explode('/', trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/') ?? '/');
        foreach ($segments as $key => $segment)
            if ($segment)
                $seg = $this->trie->searchPrefix([$segment]);
        $routerDispatcher->dispatch($seg);
    }

    public function __call($name, $arguments)
    {
        $clause = $arguments[0];
        if (count($arguments) > 1) {
            $clause = $arguments;
        }
        $this->clauses[strtolower($name)] = $clause;
        return $this;
    }

    function routeToRegex($url)
    {
        // Escapa os caracteres especiais da url
        $url = preg_quote($url, '/');
        // Substitui os parâmetros entre chaves por grupos nomeados opcionais
        $url = preg_replace('/\{([a-z]+)\}/', '(?P<\1>[^\/]+)?', $url);
        // Adiciona o início e o fim da expressão regular
        $url = '/^' . $url . '$/';
        // Retorna a expressão regular
        return $url;
    }
}
