<?php

namespace Engine\Implementations;

use Engine\Contracts\Request\Request;
use Engine\Contracts\Route\Location;
use Engine\Implementations\Component\Storage as StorageComponentsImpl;

use Engine\Implementations\Provider\Storage as StorageProvidersImpl;

use Engine\Implementations\Route\Storage as StorageRoutesImpl;

use Engine\Implementations\Middleware\Storage as StorageMiddlewareImpl;

use Engine\Contracts\Component\Storage as StorageComponents;

use Engine\Contracts\Provider\Storage as StorageProviders;

use Engine\Contracts\Route\Storage as StorageRoutes;

use Engine\Contracts\Middleware\Storage as StorageMiddleware;


use \Engine\Contracts\App as Contract;

class App implements Contract
{

    private $providers;

    private $components;

    private $routes;

    private $middlewares;


    /**
     * App constructor.
     * @param array $providers
     */
    function __construct()
    {

        $this->providers = new StorageProvidersImpl($this);

        $this->components = new StorageComponentsImpl($this);

        $this->routes = new StorageRoutesImpl();

        $this->middlewares = new StorageMiddlewareImpl();

    }


    function start()
    {

        $this->providers()->register();

        $request = $this->components()->make(Request::class);

        $location = $this->components()->make(Location::class);

        return $location->location($request->uri());
    }

    function components():StorageComponents
    {
        return $this->components;
    }

    function routes():StorageRoutes
    {
        return $this->routes;
    }

    function providers():StorageProviders
    {
        return $this->providers;
    }


    function middlewares():StorageMiddleware
    {
        return $this->middlewares;
    }

}
