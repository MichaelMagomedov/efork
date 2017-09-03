<?php

namespace Engine\Implementations;

use Engine\Contracts\Request\Request;
use Engine\Contracts\Route\Location;
use Engine\Implementations\Component\Storage as StorageComponentsImpl;

use Engine\Implementations\Provider\Storage as StorageProvidersImpl;

use Engine\Implementations\Route\Storage as StorageRoutesImpl;

use Engine\Implementations\Middleware\Storage as StorageMiddlewareImpl;

use Engine\Implementations\Config\Storage as StorageConfigImpl;

use Engine\Contracts\Component\Storage as StorageComponents;

use Engine\Contracts\Provider\Storage as StorageProviders;

use Engine\Contracts\Route\Storage as StorageRoutes;

use Engine\Contracts\Middleware\Storage as StorageMiddleware;

use Engine\Contracts\Config\Storage as StorageConfig;


use \Engine\Contracts\App as Contract;

class App implements Contract
{

    private $providers;

    private $components;

    private $routes;

    private $middlewares;

    private $configs;


    /**
     * App constructor.
     * @param array $providers
     */
    function __construct()
    {

        $this->providers = new StorageProvidersImpl();

        $this->components = new StorageComponentsImpl();

        $this->routes = new StorageRoutesImpl();

        $this->middlewares = new StorageMiddlewareImpl();

        $this->configs = new StorageConfigImpl();

    }


    function start()
    {

        session_start();
        
        setApp($this);

        $this->providers()->register();

        $request = $this->components()->make(Request::class);

        $location = $this->components()->make(Location::class);

        echo $location->location($request->url());
    }

    function components():StorageComponents
    {
        return $this->components;
    }

    function routes():StorageRoutes
    {
        return $this->routes;
    }

    function configs():StorageConfig
    {
        return $this->configs;
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
