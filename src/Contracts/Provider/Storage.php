<?php

namespace Engine\Contracts\Provider;

interface Storage
{

    function add(string $class);
    
    function register();

}