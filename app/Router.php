<?php

namespace App\Routes;

class Router
{
     private $routes = [];

     public function register(
          string $route,
          callable|array $action
     ): self {
          $this->routes[$route] = $action;
          return $this;
     }

     public function resolve(string $requestUri){
          $route = explode('?', $requestUri)[0];

          $action = $this->routes[$route] ?? null;

          if (!$action) {
               throw new RouteNotFoundException();
          }

          if (is_callable($action)) {
               return $action();
          }

          if (is_array($action)) {
               [$class, $method] = $action;

               if (!class_exists($class)) {
                    throw new RouteNotFoundException();
               }

               $controller = new $class();

               if (!is_callable([$controller, $method])) {
                    throw new RouteNotFoundException();
               }
               
               return (new $class)->$method();
          }
     
     }
}
