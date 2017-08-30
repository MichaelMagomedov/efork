<?php

namespace Engine\Contracts\Middleware;

interface Storage
{
    public function add(string $name, string $class);

    public function uriRegister(array $middlewareArr, array $uriRegexArr);

    public function getMidddlewares(string $method, string $regex);
}