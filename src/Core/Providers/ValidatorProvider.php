<?php

namespace Engine\Core\Providers;


use Engine\Contracts\App;
use Engine\Contracts\Provider\Base;
use Engine\Contracts\Route\Location;
use Engine\Contracts\Validator\Validator;

class ValidatorProvider implements Base
{

    public function inject()
    {
        app()->components()->add(Validator::class, function () {
            return new \Engine\Implementations\Validator\Validator();
        });
    }
}