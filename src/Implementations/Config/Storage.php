<?php
namespace Engine\Implementations\Config;

use \Engine\Contracts\Config\Storage as Contract;

class Storage implements Contract
{
    private $configs;

    public function add(string $name, array $config)
    {
        $this->configs[$name] = $config;
    }

    public function get(string $name):array
    {
        return $this->configs[$name];
    }
}