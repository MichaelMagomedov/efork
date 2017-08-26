<?php
namespace Engine\Contracts\Route;

interface Base
{


    public function getController():string;

    public function getMethod():string;

    public function getRegex():string;

    public function getRoute():string;

}