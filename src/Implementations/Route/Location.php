<?php
namespace Engine\Implementations\Route;

use Engine\Contracts\App;
use \Engine\Contracts\Route\Location as Contract;

class Location implements Contract
{


    private $app;

    /**
     * Location constructor.
     */
    public function __construct(App $app)
    {
        $this->app = $app;
    }

    public function location(string $uri)
    {
        $method = $_SERVER['REQUEST_METHOD'];

        $routes = $this->app->routes()->all($method);

        foreach ($routes as $regex => $route) {

            $routePart = null;

            if (preg_match($regex, $uri, $routePart) == true) {

                $middlewares = $this->app->middlewares()->getMidddlewares($method, $regex);

                for ($i = 0; $i < sizeof($middlewares); $i++) {

                    $middlewares[$i]->handle($this->app);

                }

                $variable = [];

                foreach ($routePart as $key => $value) {

                    if (is_string($key)) {
                        array_push($variable, $value);
                    }

                }

                $controllerObj = (new \ReflectionClass($route->getController()))->newInstance($this->app);

                return call_user_func_array(array($controllerObj, $route->getMethod()), $variable);

            }
        }

        throw new \Exception("Method not allowed");


    }

}