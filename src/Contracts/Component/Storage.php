<?php
namespace Engine\Contracts\Component;

interface Storage
{
    public function make(string $class);

    public function add(string $class, $function);

    public function singleton(string $class, $function);

    public function all():array;

    public function assotiation():array;
}