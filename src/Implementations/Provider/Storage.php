<?php

namespace Engine\Implementations\Provider;

use Engine\Contracts\App;
use \Engine\Contracts\Provider\Storage as Contract;

class Storage implements Contract
{

    private $providers = [];
    private $app;

    /**
     * Storage constructor.
     * @param $app
     */
    public function __construct(App $app)
    {
        $this->app = $app;
    }

    public function add(string $provider)
    {
        array_push($this->providers, (new \ReflectionClass($provider))->newInstance());
    }


    public function register()
    {
        foreach ($this->providers as $provider) {
            $provider->inject($this->app);
        }
    }
}