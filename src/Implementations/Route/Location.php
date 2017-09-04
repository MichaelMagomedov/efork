<?php
namespace Engine\Implementations\Route;

use \Engine\Contracts\Route\Location as Contract;

class Location implements Contract
{

    public function location(string $url)
    {
        $method = $_SERVER['REQUEST_METHOD'];

        $routes = app()->routes()->all($method);

        foreach ($routes as $regex => $route) {

            $routePart = null;

            if (preg_match($regex, $url, $routePart) == true) {

                $middlewares = app()->middlewares()->getMidddlewares($method, $regex);

                for ($i = 0; $i < sizeof($middlewares); $i++) {

                    $middlewares[$i]->handle();

                }

                $variable = [];

                foreach ($routePart as $key => $value) {

                    if (is_string($key)) {
                        array_push($variable, $value);
                    }

                }

                $controllerObj = (new \ReflectionClass($route->getController()))->newInstance();

                try {

                    return call_user_func_array(array($controllerObj, $route->getMethod()), $variable);

                } catch (\Exception $e) {


                    abort(500, $e->getMessage());

                }
            }
        }

        abort(404, 'Method not allowed');

    }

}