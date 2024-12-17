<?php

namespace Core;

class Router
{
    protected array $routes = [];
    protected array $route_params = [];

    protected Request $request;
    protected Response $response;

    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    public function getParams(): array
    {
        return $this->route_params;
    }

    public function getRoutes(): array
    {
        return $this->routes;
    }

    public function add($path, $callback, $method): self
    {
        $path = trim($path, '/');
        if (is_array($method)) {
            $method = array_map('strtoupper', $method);
        } else {
            $method = [strtoupper($method)];
        }
        $this->routes[] = [
            'path' => "{$path}",
            'callback' => $callback,
            'method' => $method,
        ];
        return $this;
    }

    public function get($path, $callback): self
    {
        return $this->add($path, $callback, 'get');
    }

    public function post($path, $callback): self
    {
        return $this->add($path, $callback, 'post');
    }

    public function dispatch(): mixed
    {
        $path = $this->request->getPath();
        $route = $this->matchRoute($path);
        if ($route === false) {
            $this->response->setResponseCode(404);
            abort();
            die;
        }
        if (is_array($route['callback'])) {
            $route['callback'][0] = new $route['callback'][0];
        }

        return call_user_func_array($route['callback'], $this->route_params);
    }

    protected function matchRoute($path): mixed
    {
        foreach ($this->routes as $route) {

            $pattern = preg_replace('/\{([a-zA-Z0-9_]+)\}/', '([a-zA-Z0-9_]+)', $route['path']);
            $pattern = "#^{$pattern}$#";

            if(
                preg_match($pattern, $path, $matches)
                && in_array($this->request->getMethod(), $route['method'])
            )
            {
                foreach ($matches as $key => $value)
                {
                    if(is_string($key))
                    {
                        $this->route_params[] = $value;
                    }
                }
                return $route;
            }
        }
        return false;
    }
}
