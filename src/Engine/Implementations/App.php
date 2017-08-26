<?php

namespace Engine\Implementations;

use Engine\Implementations\Component\Storage as StorageComponents;
use Engine\Implementations\Provider\Storage as StorageProviders;
use \Engine\Contracts\App as Contract;

class App implements Contract
{

    private $providers;

    private $components;

    /**
     * App constructor.
     * @param array $providers
     */
    public function __construct()
    {

        $this->providers = new StorageProviders($this);

        $this->components = new StorageComponents($this);

    }


    function start()
    {
        $this->providers()->register();
    }

    function components()
    {
        return $this->components;
    }

    function providers():StorageProviders
    {
        return $this->providers();
    }

    function make(string $class)
    {

        return $this->components[$class];

    }


}
