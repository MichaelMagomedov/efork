<?php
namespace Engine\Contracts\Request;

interface Request
{
    public function input(string $string):string;
    
    public function url():string;
}