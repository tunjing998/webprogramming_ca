# Rapid PHP MVC Library
This is the **Rapid** PHP MVC library created for GD2/CO2a Web Development (2018/19) CA3. This version has no in-built support or helpers for Models, so it is really just a VC framework at this point (we'll add model support later).

On this page:

* [Getting Started](#getting-started)
* [Working with Controllers](#working-with-controllers)
* [Working with Templates](#working-with-templates)
* [Working with the Router](#working-with-the-router)
* [Exception Handling](#exception-handling)
* [Reporting Bugs](#reporting-bugs)

## Getting Started
@TODO

## Working with Controllers
@TODO

## Working with Templates
@TODO

## Working with the Router
@TODO

## Exception Handling
Rapid defines it's own class of Exception objects which *may* have request and response objects attached to them for usage in catch blocks. If these objects are available, you should use them to handle errors internally in the framework. The following example demonstrates a structure for your `index.php`, and there is an assumption that there is a `main` layout, and an `error` view:

```php
<?php

  try {
    // All set-up and dispatching here
  }

  // Handle Rapid exceptions
  catch(\Rapid\Exception $e) {

    // The exception happened before dispatch, so
    // there are no request or response objects.
    // Throw the error onward
    if ($e->getResponseObject() === NULL) {
      throw $e;
    }

    $e->getResponseObject()->status(500);
    $e->getResponseObject()->render('main', 'error', [
      'message' => $e->getMessage();
      'code'    => $e->getCode();
    ]);
  }

  // Final, fatal Exception handler
  catch(Exception $e) {
    http_response_code(500);
    exit();
  }

?>
```

Rapid provides the following Exception classes (all in the `Rapid` namespace):

Exception                         | Description
----------------------------------|---------------------
`Exception`                       | Generic Rapid Exception object
`RequestAlreadyFinishedException` | Thrown when your code tries to modify a response, but the response has already been sent
`LayoutNotFoundException`         | Thrown when the layout component of a template could not be found or opened
`ViewNotFoundException`           | Thrown when the view component of a template could not be found or opened
`RouteRedeclarationException`     | Thrown when your code attempts to redeclare a route that has already been declared
`ControllerNotFoundException`     | Thrown when your code attempts to dispatch to a controller that could not be found or opened

These Exception types can be used for catch specialization:

```php
catch(\Rapid\RouteNotFoundException $e) {
  $e->getResponseObject()->status(404);
  $e->getResponseObject()->render('main', '404');
}
```

Rapid Exception types add the following methods to the global Exception type:

Exception                         | Description
----------------------------------|---------------------
`getRequestObject()`              | Get the Rapid Request object. `NULL` if an exception was thrown before dispatching
`getResponseObject()`             | Get the Rapid Response object. `NULL` if an exception was thrown before dispatching

## Reporting Bugs
To report bugs in the library, report them on the [Issues Page](https://gitlab.comp.dkit.ie/gavins/rapid-starter-project/issues) on GitLab, or email them to **shane.gavin@dkit.ie**.