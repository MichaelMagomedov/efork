<?php

namespace Engine\Implementations\Route;

use Engine\Contracts\Route\Action;
use \Engine\Contracts\Route\Base as Contract;

class Base implements Contract
{

    private $controller;

    private $method;

    private $regex;

    private $route;


    /**
     * Base constructor.
     * @param $regex
     */
    public function __construct(string $route, string $controller, string $method)
    {

        $regex = $this->makeRegex($route);
        $this->regex = $regex;
        $this->route = $route;
        $this->method = $method;
        $this->controller = $controller;

    }


    private function makeRegex($route)
    {

        if (preg_match('/[^-:\/_{}()a-zA-Z\d]/', $route))
            return false; // Invalid pattern

        // Turn "(/)" into "/?"
        $route = preg_replace('#\(/\)#', '/?', $route);

        $allowedParamChars = '[a-zA-Z0-9\_\-]+';
        // Create capture group for '{parameter}'
        $route = preg_replace(
            '/{(' . $allowedParamChars . ')}/',    # Replace "{parameter}"
            '(?<$1>' . $allowedParamChars . ')', # with "(?<parameter>[a-zA-Z0-9\_\-]+)"
            $route
        );

        // Add start and end matching
        $regex = "@^" . $route . "$@D";

        return $regex;
    }


    public function getRegex():string
    {
        return $this->regex;
    }


    /**
     * @return mixed
     */
    public function getRoute():string
    {
        return $this->route;
    }


    public function getController():string
    {
        return $this->controller;
    }


    /**
     * @return mixed
     */
    public function getMethod():string
    {
        return $this->method;
    }


}