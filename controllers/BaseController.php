<?php

namespace Supermarket\controllers;

class BaseController {
   private $post = [];

   public function __construct() {
      $this->post = $_POST ?? [];
   }
   /**
    * __call magic method.
    */
   public function __call($name, $arguments) {
      $this->sendOutput('', array('HTTP/1.1 404 Not Found'));
   }
   /**
    * Get URI elements.
    *
    * @return array
    */
   protected function getUriSegments() {
      $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
      $uri = explode('/', $uri);
      return $uri;
   }
   /**
    * Get querystring params.
    *
    * @return array
    */
   protected function getQueryStringParams() {
      return parse_str($_SERVER['QUERY_STRING'], $query);
   }
   /**
    * Send API output.
    *
    * @param mixed $data
    * @param string $httpHeader
    */
   protected function sendOutput($data, $httpHeaders = array()) {
      header_remove('Set-Cookie');
      if (is_array($httpHeaders) && count($httpHeaders)) {
         foreach ($httpHeaders as $httpHeader) {
            header($httpHeader);
         }
      }
      echo $data;
      exit;
   }

   // usar similar a codeigniter tratando os valores de entrada
   public function getPost($field = null, $default = null) {
      if ($field === null) {
         return $this->post;
      } else {
         return ($this->post[$field]) ?? $default;
      }
   }
}
