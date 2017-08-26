<?php
namespace Engine\Contracts\Component;

interface Storage
{
    function make(string $class):\ReflectionObject;

    function add(string $class, $function):\ReflectionObject;
}