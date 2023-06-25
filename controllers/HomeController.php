<?php

namespace Supermarket\Controllers;

class HomeController {
   public static function index() {
      //$tasks = App::get('db')->selectAll('tasks', Task::class);
      $content = partial('home.index');

      return view('layout.main', ['content'=>$content]);
   }
}
