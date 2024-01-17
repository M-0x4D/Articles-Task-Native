<?php

function resolve($routeFromRequest, $body)
{
    $routes = require(__DIR__ . "\\routes.php");
    foreach ($routes as $routeFromFile => $controllerWithMethod) {
        if ($routeFromRequest == $routeFromFile) {
            foreach ($controllerWithMethod as $controller => $method) {
                // Create a reflection object for the class
                $reflectionClass = new \ReflectionClass($controller);

                // // Check if a method is static
                $staticMethod = $reflectionClass->getMethod($method);

                $args = $body;
                if ($staticMethod->isStatic()) {
                    return $controller::method($args);
                } else {
                    $controller = new $controller();
                    return $controller->$method($args);
                }
            }
        }
    }
}
