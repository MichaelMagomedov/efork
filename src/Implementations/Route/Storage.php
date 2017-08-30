<?php

namespace Engine\Implementations\Route;

use Engine\Implementations\Route\Base as Route;
use \Engine\Contracts\Route\Storage as Contract;

class Storage implements Contract
{

    private $routes = [
        'GET' => [],
        'POST' => []
    ];

    protected function checkMethodType(string $method):bool
    {

        $methodObj = $this->routes[strtoupper($method)];

        if (isset($methodObj)) {

            return true;

        }

        return false;
    }

    protected function exception()
    {

        throw new \Exception("Method type not registred or not permission");

    }

    public function add(string $method, string $route, string $controller, string $action)
    {
        $routeObj = new Route($route, $controller, $action);

        if ($this->checkMethodType($method) == true) {

            $this->routes[strtoupper($method)][$routeObj->getRegex()] = $routeObj;

        } else {

            $this->exception();

        }
    }

    public function all(string $method):array
    {
        if ($this->checkMethodType($method) == true) {

            return $this->routes[$method];

        }

        $this->exception();

    }
}