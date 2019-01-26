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
   * The current implementation only supports GET and POST
   * request methods. Would it be difficult to add support
   * for the remaining request methods (PUT, DELETE, etc)?
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
      $this->basePath  = dirname($_SERVER['PHP_SELF']);
      $this->params    = NULL;
      $this->query     = $_GET;
      $this->body      = $_POST;
      $this->headers   = getallheaders();
      $this->remoteIp  = $_SERVER['REMOTE_ADDR'];
      $this->method    = $_SERVER['REQUEST_METHOD'];
      $this->url       = $this->getLocalPath();
    }

    /**
     * Utility method to get the requested path, minus the base
     * path of the current script (relative to the document root).
     */
    private function getLocalPath() {

      // Get requested path, minus a query string if there is one
      $localPath = explode('?', $_SERVER['REQUEST_URI'])[0];

      // Get requested path, minus the fragment string if there is one
      $localPath = explode('#', $localPath)[0];

      // Remove basePath from localPath
      // Snippet taken from https://stackoverflow.com/questions/4517067
      // ^^^ That's a reference
      if (substr($localPath, 0, strlen($this->basePath)) === $this->basePath) {
        $localPath = substr($localPath, strlen($this->basePath));
      }

      return $localPath;
    }

    /**
     * Params will have to be set later than instantiation.
     * However, once set, we don't want the param array to be
     * mutable, so we will make sure they can only be set once
     */
    public function setParamsOnce($params) {
      if ($this->params === NULL && is_array($params)) {
        $this->params = $params;
      }
    }

    /**
     * Get a single named parameter from the request URL
     */
    public function param($name) {
      return $this->params !== NULL
        ? $this->params[$name] ?? NULL
        : NULL;
    }

    /**
     * Get a single named query string value from the request
     * URL. (->query('foo') is an alias of $_GET['foo'])
     */
    public function query($name) {
      return $this->query[$name] ?? NULL;
    }

    /**
     * Get a single named posted value from the request
     * (->body('foo') is an alias of $_POST['foo'])
     */
    public function body($name) {
      return $this->body[$name] ?? NULL;
    }

    /**
     * Get a single, named request header
     */
    public function header($name) {
      return $this->headers[$name] ?? NULL;
    }

    /**
     * Get the requesting user's IP address
     */
    public function remoteIp() {
      return $this->remoteIp;
    }

    /**
     * Get the calculated request path (minus base path)
     */
    public function url() {
      return $this->url;
    }

    /**
     * Get the request method (GET/POST/PUT, etc.)
     */
    public function method() {
      return $this->method;
    }

    /**
     * Get the app's base path (relation to doc root)
     */
    public function basePath() {
      return $this->basePath;
    }

  }


  ##########################################################
  # Response
  ##########################################################

  class Response {

    public function __construct() {
      throw new \Exception('Response class has not yet been implemented');
    }

  }


  ##########################################################
  # Renderer
  ##########################################################

  class Renderer {

    public const VIEW_PLACEHOLDER = '{{--VIEW--}}';

    public function __construct() {
      throw new \Exception('Renderer class has not yet been implemented');
    }

  }


  ##########################################################
  # Router
  ##########################################################

  class Router {

    private $routes;

    public function __construct() {
      $this->routes = [
        'GET'  => [],
        'POST' => []
      ];
    }

    /**
     * Register a new GET-based route
     */
    public function GET($route, $controllerName) {

      if (isset($this->routes['GET'][$route])) {
        throw new \Exception('Rapid: GET Route redeclaration attempt');
      }

      $this->routes['GET'][$route] = $controllerName;
    }

    /**
     * Register a new POST-based route
     */
    public function POST($route, $controllerName) {

      if (in_array($route, $this->routes['POST'])) {
        throw new \Exception('Rapid: POST Route redeclaration attempt');
      }

      $this->routes['POST'][$route] = $controllerName;
    }

    /**
     * Processes a request by:
     *   1) Creating a new request object
     *   2) Checks if the requested route has a controller
     *   3) Loads and calls the controller (or throws)
     * @param $req a Rapid Request Object
     */
    public function dispatch($req) {

      $controller = NULL;
      $routes     = $this->routes[$req->method()] ?? [];
      $res        = NULL; // @TODO we need a response object

      // Is there a matching route declaration?
      foreach($routes as $route=>$controllerName) {

        $normal_pattern = '@^' . rtrim($route, '/') . '/?$@';
        $matches        = NULL;
        $matched        = preg_match($normal_pattern, $req->url(), $matches);

        // If found, rry to include the contoller
        if ($matched) {
          $controller = @include_once("controllers/$controllerName.php");
          $req->setParamsOnce($matches);
          break;
        }
      }

      // No valid controller was found
      if (!is_callable($controller)) {
        throw new \Exception('Controller could not be found or is not callable');
      }

      // Otherwise, we're all good to go.
      // The controller will handle the request
      return $controller($req, $res);
    }

  }

?>