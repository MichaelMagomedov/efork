<?php

namespace Engine\Implementations\Component;

use Engine\Contracts\App;
use \Engine\Contracts\Component\Storage as Contract;

class Storage implements Contract
{

    private $association = [

    ];
    private $components = [

    ];

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


    public function make(string $class)
    {
        $asscoiation = $this->association[$class];

        if ($asscoiation == "singleton") {

            return $this->components[$asscoiation][$class];

        } else {

            return call_user_func($this->components[$asscoiation][$class],$this->app);

        }
    }

    public function add(string $class, $function)
    {
        $this->association[$class] = "item";
        $this->components["item"][$class] = $function;
    }

    public function singleton(string $class, $function)
    {
        $this->association[$class] = "singleton";
        $obj = $function($this->app);
        $this->components["singleton"][$class] = $obj;
    }

    public function all():array
    {
        return $this->components;
    }

    public function assotiation():array
    {
        return $this->association;
    }
}