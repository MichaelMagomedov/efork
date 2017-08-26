<?php

namespace Engine\Implementations\Component;

use Engine\Contracts\App;
use \Engine\Contracts\Component\Storage as Contract;

class Storage implements Contract
{

    private $components = [];
    private $app;

    /**
     * Container constructor.
     * @param $app
     */
    public function __construct(App $app)
    {

        $this->app = $app;
        $this->components[Contract::class] = $this;

    }


    function make(string $class):\ReflectionObject
    {
        return $this->components[$class];
    }

    function add(string $class, $function):\ReflectionObject
    {

        $obj = $function($this->app);

        $this->components[$class] = $obj;

    }
}