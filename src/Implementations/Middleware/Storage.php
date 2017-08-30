<?php

namespace Engine\Implementations\Middleware;

use Engine\Contracts\App;
use \Engine\Contracts\Middleware\Storage as Contract;

class Storage implements Contract
{

    private $middlewares = [];

    private $associate = [];

    public function add(string $name, string $class)
    {
        $this->middlewares[strtolower($name)] = (new \ReflectionClass($class))->newInstance();
    }

    public function uriRegister(array $middlewareArr, array $uriRegexArr)
    {
        foreach ($middlewareArr as $middleware) {

            foreach ($uriRegexArr as $uri) {

                if (!isset($this->associate[$uri["METHOD"]][$uri["REGEX"]])) {

                    $this->associate[$uri["METHOD"]][$uri["REGEX"]] = [];

                }

                array_push($this->associate[$uri["METHOD"]][$uri["REGEX"]], strtolower($middleware));
            }

        }
    }

    public function getMidddlewares(string $method, string $regex)
    {

        if (isset($this->associate[$method][$regex])) {

            $middlewares = [];

            foreach ($this->associate[$method][$regex] as $middlewareName) {

                array_push($middlewares, $this->middlewares[$middlewareName]);

            }

            return $middlewares;

        }
        return [];
    }
}