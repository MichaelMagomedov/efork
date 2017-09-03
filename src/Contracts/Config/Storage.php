<?php
namespace Engine\Contracts\Config;

interface Storage
{
    public function add(string $name, array $config);

    public function get(string $name):array;
}