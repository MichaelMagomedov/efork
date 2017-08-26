<?php

namespace Engine\Core\Providers;


use Engine\Contracts\App;
use Engine\Contracts\Provider\Base;
use Engine\Contracts\Route\Location;

class LocationProvider implements Base
{

    public function inject(App $app)
    {
        $app->components()->singleton(Location::class, function ($app) {
            return new \Engine\Implementations\Route\Location($app);
        });
    }
}