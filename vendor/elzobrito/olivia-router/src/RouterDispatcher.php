<?php

namespace OliviaRouter;


class RouterDispatcher
{
    private $route;
    private $clauses;

    public function __construct(array $route, array $clauses)
    {
        $this->route = $route;
        $this->clauses = $clauses;
    }

    public function dispatch($actions)
    {
        $_SESSION['e404'] = true;
        if ($_SERVER['REQUEST_METHOD'] === strtoupper($actions['route']['http_method'])) {
            if (isset($actions['route']['middleware']) != null) {
                $middlewares = is_array($actions['route']['middleware']) ? $actions['route']['middleware'] : [$actions['route']['middleware']];
                $this->executeMiddlewares($middlewares);
            }

            $this->executeHandler($actions['route']['handler']);
            $_SESSION['e404'] = false;
        }
    }

    private function executeMiddlewares(array $middlewares)
    {
        foreach ($middlewares as $middleware) {
            $callMiddleware = $this->callMiddlewareClass($middleware . '#handle');
            $middlewareInstance = MiddlewareFactory::createMiddleware($callMiddleware['middleware']);
            $middlewareInstance->handle();
        }
    }

    private function executeHandler($handler, $params = null, $request_data = null)
    {
        $callHandler = $this->callHandlerClass($handler);
        $handlerInstance = ControllerFactory::createController($callHandler['controller']);
        $handlerInstance->{$callHandler['action']}($params);
    }

    private function callMiddlewareClass($str)
    {
        $callables = explode('#', $str);
        $controllerParts = array_map('ucfirst', explode('/', $callables[0]));
        $middleware = $_SESSION['App_folder'] . '\\' . $_SESSION['Middleware_folder'] . '\\' . implode('\\', $controllerParts);
        return ['middleware' => $middleware, 'action' => $callables[1]];
    }

    private function callHandlerClass($str)
    {
        $callables = explode('#', $str);
        $controllerParts = array_map('ucfirst', explode('/', $callables[0]));
        $controller = $_SESSION['App_folder'] . '\\' . $_SESSION['Controller_folder'] . '\\' . implode('\\', $controllerParts);
        return ['controller' => $controller, 'action' => $callables[1]];
    }
}
