<?php

namespace Engine\Contracts;

use Engine\Contracts\Provider\Storage as ProvidersStorage;
use Engine\Contracts\Provider\Storage as ComponentsStorage;

interface App
{
    function start();

    function make(string $class);

    function providers():ProvidersStorage;

    function components():ComponentsStorage;

}
