<?php

namespace App;

class RouteNotFoundException extends \Exception 
{

}

class Router
{
     private $routes = [];

     public function register(
          string $route,
          callable $action
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

          return $action();
     }
     
}
