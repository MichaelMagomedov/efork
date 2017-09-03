<?php

namespace Engine\Implementations\Provider;

use \Engine\Contracts\Provider\Storage as Contract;

class Storage implements Contract
{

    private $providers = [];


    public function add(string $provider)
    {
        array_push($this->providers, (new \ReflectionClass($provider))->newInstance());
    }


    public function register()
    {
        foreach ($this->providers as $provider) {
            $provider->inject();
        }
    }
}