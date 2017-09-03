<?php

namespace Engine\Contracts\Route;

interface Storage
{
    public function add(string $method, string $route, string $controller, string $action):array ;

    public function all(string $method):array;
}