<?php

  // The location of /controllers and /templates must
  // be part of PHP's include path
  set_include_path(__DIR__);

  // Include the Rapid library
  require_once('lib/Rapid.php');

  // Create a new Router instance
  $app = new \Rapid\Router();

  // Define some routes. Here: requests to / will be
  // processed by the controller at controllers/Home.php
  $app->GET('/',        'Home');
  $app->GET('/example', 'Example');

  // Process the request
  $app->dispatch();

?>