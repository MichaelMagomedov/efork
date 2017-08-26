<?php

namespace Engine\Contracts\Route;

interface Storage
{
    public function add(string $route, string $controller, string $method);

    public function all();
}