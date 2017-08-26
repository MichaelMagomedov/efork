<?php

namespace Engine\Implementations\Route;

use Engine\Implementations\Route\Base as Route;
use \Engine\Contracts\Route\Storage as Contract;

class Storage implements Contract
{

    private $routes = [

    ];

    public function add(string $route, string $controller, string $method)
    {
        $routeObj = new Route($route, $controller, $method);
        $this->routes[$routeObj->getRegex()] = $routeObj;
    }

    public function all()
    {
        return $this->routes;
    }
}