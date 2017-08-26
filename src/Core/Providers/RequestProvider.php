<?php

namespace Engine\Core\Providers;


use Engine\Contracts\App;
use Engine\Contracts\Provider\Base;
use Engine\Contracts\Request\Request;

class RequestProvider implements Base
{

    public function inject(App $app)
    {
        $app->components()->singleton(Request::class, function ($app) {
            return new \Engine\Implementations\Request\Request();
        });
    }
}