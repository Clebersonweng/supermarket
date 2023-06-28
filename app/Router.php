<?php

namespace Supermarket\App;

use Exception;

class Router
{
   protected $routes = [
      'GET' => [],
      'POST' => [],
      'PUT' => [],
   ];

   public static function load(string $file)
   {
      $router = new static();
      require $file;

      return $router;
   }

   public function get($uri, $controller)
   {
      $this->routes['GET'][$uri] = $controller;
   }

   public function post($uri, $controller)
   {
      $this->routes['POST'][$uri] = $controller;
   }

   // public function put($uri, $controller)
   // {
   //    $this->routes['PUT'][$uri] = $controller;
   // }

   public function direct(string $uri, string $method)
   {
      // if contain the slash exist action in the controller
      if ( strpos($uri, '/') !== false ) { // this method you need pass by slash the action example => http://localhost:8080/type-products/getById?id=24
         $segments = explode('/', $uri);
         $controller = explode('@', $this->routes[$method][$segments[0]])[0];

         $action = $segments[1];
         return $this->callAction($controller, $action);
      }
      else { // this block only accept one action by method
         if (array_key_exists($uri, $this->routes[$method])) {
            $action = $this->routes[$method][$uri];
            return $this->callAction(...explode('@', $action));
         }
      }
      return 'views/404.php';
   }

   protected function callAction($controller, $action) {

      $controller =  "Supermarket\\Controllers\\{$controller}";
      $controller = new $controller;

      if (!method_exists($controller, $action)) {
         throw new Exception("{$controller} does not have {$action}");
      }

      return $controller->$action();
   }
}
