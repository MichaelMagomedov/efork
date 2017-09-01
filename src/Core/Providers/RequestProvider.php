<?php

namespace Engine\Core\Providers;


use Engine\Contracts\App;
use Engine\Contracts\Provider\Base;
use Engine\Contracts\Request\Request;

class RequestProvider implements Base
{

    public function inject()
    {
        app()->components()->singleton(Request::class, function () {
            return new \Engine\Implementations\Request\Request();
        });
    }
}