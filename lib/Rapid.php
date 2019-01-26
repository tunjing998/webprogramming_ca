<?php namespace Rapid; ?>
<?php

  /**
   * This is the Rapid MVC framework created for GD2/CO2a
   * Web Development (2018/19) CA3. This version has no
   * in-built support or helpers for Models, so it is really
   * just a VC framework (we'll add models later).
   *
   * Implementation details are described in comments in
   * this file. Usage details will be documented in a
   * README.md file in the root of this project.
   *
   * To limit the number of requires needed per request,
   * all of this library in included in this one file.
   *
   * This library makes use of a namespace. To access the
   * classes in this library, you must reference their
   * namespace:
   *    Wont' work: new Request();
   *    Will work : new \Rapid\Request();
   * Lear more about namespaces at:
   *    https://php.net/manual/en/language.namespaces.php
   */

  ##########################################################
  #### !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! #####
  #### !!! YOU SHOULD NEVER NEED TO EDIT THIS FILE !!! #####
  #### !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! #####
  ##########################################################


  ##########################################################
  # Exceptions
  ##########################################################


  ##########################################################
  # Request
  ##########################################################

  class Request {

    private $basePath;
    private $params;
    private $query;
    private $body;
    private $headers;
    private $remote_ip;
    private $method;
    private $url;

    public function __construct() {
      throw new Exception('Request class has not yet been implemented');
    }

  }


  ##########################################################
  # Response
  ##########################################################

  class Response {

    public function __construct() {
      throw new Exception('Response class has not yet been implemented');
    }

  }


  ##########################################################
  # Renderer
  ##########################################################

  class Renderer {

    public function __construct() {
      throw new Exception('Renderer class has not yet been implemented');
    }

  }


  ##########################################################
  # Router
  ##########################################################

  class Router {

    public function __construct() {
      throw new Exception('Router class has not yet been implemented');
    }

  }

?>