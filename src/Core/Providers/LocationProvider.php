<?php

namespace Engine\Core\Providers;


use Engine\Contracts\App;
use Engine\Contracts\Provider\Base;
use Engine\Contracts\Route\Location;

class LocationProvider implements Base
{

    public function inject()
    {
        app()->components()->add(Location::class, function () {
            return new \Engine\Implementations\Route\Location();
        });
    }
}