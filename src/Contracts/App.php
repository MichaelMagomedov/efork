<?php

namespace Engine\Contracts;

use Engine\Contracts\Provider\Storage as ProvidersStorage;
use Engine\Contracts\Component\Storage as ComponentsStorage;
use Engine\Contracts\Route\Storage as RouteStorage;
use Engine\Contracts\middleware\Storage as MiddlewareStorage;

interface App
{
    function start();

    function providers():ProvidersStorage;

    function components():ComponentsStorage;

    function routes():RouteStorage;

    function middlewares():MiddlewareStorage;

}
