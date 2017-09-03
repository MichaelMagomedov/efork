<?php

namespace Engine\Contracts\Provider;

interface Storage
{

    public function add(string $class);
    
    public function register();

}