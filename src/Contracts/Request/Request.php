<?php
namespace Engine\Contracts\Request;

interface Request
{
    public function input(string $string):string;

    public function all():array;

    public function url():string;

    public function file(string $name);

}