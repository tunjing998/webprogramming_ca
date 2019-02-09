# Rapid PHP MVC Framework
This is the **Rapid** PHP MVC framework created for GD2/CO2a Web Development (2018/19) CA3. This version has no in-built support or helpers for Models, so it is really just a VC framework at this point (you'll have to add model support yourself).

On this page:

* [Getting Started](#getting-started)
* [Working with the Router](#working-with-the-router)
* [Working with Controllers](#working-with-controllers)
* [Working with Templates](#working-with-templates)
* [Example Controller Flow (Some Pseudo-code)](#example-controller-flow-some-pseudo-code)
* [Exception Handling](#exception-handling)
* [Base Path](#base-path)
* [Reporting Bugs](#reporting-bugs)


## Getting Started
1. Download this repository (note: download, don't clone).
2. Extract, rename, and move such that the project is located at `/path/to/XAMPP/htdocs/wp_ca3_lastName_firstName/` (replacing names with your own);
3. Copy `config.php.sample` to `config.php` (note that this is gitignored -- it should **not** be included in your repository).
4. Initialize the downloaded folder as a GIT repository (`git init`);
5. Create a repository for your project on GitLab, GitHub, or BitBucket
6. Make the above repository the *remote* for your *local* repository (`git remote add origin ...`).
7. Replace the contents of this README with headings for your own README content
8. Edit the project `.htaccess` file to reflect the new location for the rewrite rule
8. Make your first commit and push.
9. **Remove any files which you don't need for your project** (the example controllers, etc).

## Working with the Router
The router is the main control node in Rapid. It is the piece of code that is responsible for defining the routes your site will support; for mapping those routes to a controller; for inspecting the URL a user has requested; for checking if this URL matches one of your routes; for loading the controller for a given route; for calling the controller for a given route (i.e. for handing processing off to the controller).

To use the router, create a new Router instance in your index.php file, define the routes you want to support, then call the  router's `dispatch()` method to kick-off processing. Here's an example of what a minimal `index.php` will look like:

```php
<?php

  // Include the Rapid library
  require_once('lib/Rapid.php');

  // Create a new Router instance
  $app = new \Rapid\Router();

  // Define routes
  $app->GET('/',      'Home');
  $app->GET('/about', 'About');

  // Begin processing
  $app->dispatch();

?>
```

The current Router implementation only supports defining routes for `GET` and `POST` method requests.

Note that route definitions are RegEx-based, so you can use any valid RegEx as part of a route definition:

```php
// Match /user/[any2numbers] e.g. /user/42
$app->GET('/user/[0-9]{2}', 'Home');
```

The use of named capture groups is also supported. In the following example, the user ID (2 numbers in this example) is captured in a group named `id`:

```php
$app->GET('/user/(?<id>[0-9]{2})', 'Home');
```

Rapid provides access to named capture groups through the `param()` method of a Request object. E.g. from controller:
```php
<?php return function($req, $res) {

  $id = intval($req->param('id'));

} ?>
```


## Working with Controllers
Once you have set up a route definition (see: working with the router), you must add a controller for the route to the `controllers` directory. If, in your route definition, you named your controller `Home`, then the controller file should be called `Home.php`. Therefore you should create the file at `controllers/Home.php`.

The controller file (`Home.php` in this example) must **return** a function as shown below. Rapid, when it finds the controller, will call this function.

Snippet from `index.php`:

```php
// GET requests to / should be handled by the Home controller
$app->GET('/', 'Home');
```

Contents of `controllers/Home.php`:

```php
<?php return function($req, $res) {
  // Your controller code goes here
}?>
```

As can see above, when your controller is called, it will be passed 2 objects -- 1 (named `$req` above) represents the user's request, and the other (named `$res` above) represents the response you will send to the user. These objects are described below:

### The `Request` Object
Contains information on an individual request, including any query string values, body values, and URL parameter values that have been received. The request object has the following methods:

Method                     | Description
---------------------------|---------------------------------------
`param($name)`             | Get a single, named URL parameter, or `NULL` if the value does not exist (Note: does not exist !== is empty)
`query($name)`             | Get a single, named query string ($_GET) value, or `NULL` if the value does not exist (Note: does not exist !== is empty)
`body($name)`              | Get a single, named body ($_POST) value, or `NULL` if the value does not exist (Note: does not exist !== is empty)
`header($name)`            | Get a single, named header (e.g. 'User-Agent') value, or `NULL` if the value does not exist (Note: does not exist !== is empty)
`remoteIp()`               | Get the IP address of the user making the request
`url()`                    | Get the URL the user has requested, minus the project base path
`method()`                 | Get the method used for the request (e.g. `GET` or `POST`)
`basePath()`               | Returns the difference between your server's Document Root and your project's index.php file (see dedicated section)

### The `Response` Object
Provides methods for formulating a response to a user's request:

Method                     | Description
---------------------------|---------------------------------------
`currentState()`           | Returns all of the object's internal tracking values (headers buffered, status, is the response finished or not)
`status($status)`          | Set the response status code (e.g. `200`)
`header($key,$value)`      | Set a single, named header for the response. E.g. `header('Content-Type', 'text/html')`
`end()`                    | Mark the response as finished. Any attempt to modify the response after this will throw an exception
`send($content)`           | The status code will be set; all buffered headers will be set; the specified content (body) will be sent; the response will be marked finished
`render(...)`              | See section on working with templates
`redirect($url)`           | Redirect the user to a different route. This will redirect the user, and kill the current script.


## Working with Templates
Templates are the view component that will be used to construct the HTML content that will be sent in a response. Any given template will be made up of 2 parts: a **layout** and a **view**. A **layout** will contain your header, footer, and any other content which may be common across multiple pages. A site might only have 1 layout, or may have several. A **view** will contain the HTML content that will be specific to a single resource (a single page). For this framework, layout and view files must be placed in the following locations:

Component Type | Component Name | Location
---------------|----------------|-------------------------
Layout         | `main`         | `templates/layouts/main.php`
View           | `home`         | `templates/views/home.php`

The following is an example of a **layout** file. Please note that the Renderer `VIEW_PLACEHOLDER` must be used to indicate where you would like an individual view to be rendered within the layout:

```html
<!DOCTYPE html>
<html lang='en'>
<head>
  <meta charset='UTF-8'>
  <meta name='viewport' content='width=device-width, initial-scale=1.0'>
  <title>Rapid Starter Project</title>
</head>
<body>
  <?= \Rapid\Renderer::VIEW_PLACEHOLDER ?>
</body>
</html>
```

The following is an example of a **view** file:

```html
<h1>This is a View for a Single Page</h1>
<p>Just testing</p>
```

To compile a view in a controller, you can use the Rapid Renderer's static `compile` method as shown below. To compile a template, you must specify the name of both the **layout** and the **view** that you want to compile:

```php
<?php return function($req, $res) {

  //                               layout    view
  //                                 |        |
  $html = \Rapid\Renderer::compile('main', 'home');

  // Then send to the user
  $res->send($html);

}?>
```

To save you having to compile and send in 2 steps, the Response object provides a `render()` method which will both compile your template, and send it, in one step:

```php
<?php return function($req, $res) {

  // Compile and send in 1 step
  $res->render('main', 'home');

}?>
```

To pass data to a template (layout or view), you can pass an associative array as a third argument to either of the methods shown above. This array can be accessed in the template as the variable `$locals`.

In controller:

```php
$res->render('main', 'home', [
  'name' => 'Shane'
]);
```

In view (e.g. `templates/views/home.php`):

```html
<h1>Hello, <?= $locals['name'] ?></h1>
```


## Example Controller Flow (Some Pseudo-code)
The following is an example of what a fully-implemented controller might look like. It should go without saying that the following contains some pseudo-code (the model, as example).

```php
<?php return function($req, $res) {

  $userId = intval($req->param('id'));
  $user   = MyUserModel::findOneById($userId); // <- abstract complexity away

  // User could not be found
  if ($user === NULL) {
    $res->redirect('/users?error=UserNotFound');
  }

  // Show user profile
  else {
    $res->render('SomeLayout', 'UserProfileView', [
      'user' => $user
    ]);
  }

} ?>
```

## Exception Handling
Rapid defines it's own class of Exception objects which *may* have request and response objects attached to them for usage in catch blocks. If these objects are available, you should use them to handle errors internally in the framework. The following example demonstrates a structure for your `index.php`, and there is an assumption that there is a `main` layout, and an `error` view:

```php
<?php

  // There's a lot of code repetition in here to cover
  // all scenarios -- this could be reduced. I look forward
  // to seeing your ideas for doing so in your submission

  try {
    // All set-up and dispatching here
  }

  // Handle Rapid exceptions
  catch(\Rapid\Exception $e) {

    // The exception happened before dispatch, so
    // there are no request or response objects.
    // Throw the error onward
    if ($e->getResponseObject() === NULL) {
      http_response_code(500);
      exit();
    }

    // Deal with the error in the framework
    // A helper which hid the extra catches here would
    // be a good idea.
    try {
      $e->getResponseObject()->status(500);
      $e->getResponseObject()->render('main', 'error', [
        'message' => $e->getMessage();
        'code'    => $e->getCode();
      ]);
    } catch (Exception $e) {
      http_response_code(500);
      exit();
    }

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
`RouteNotFoundException`          | Thrown when a user requests a route which has not been defined

These Exception types can be used for **catch specialization**:

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


## Base Path
To make your code as portable as possible, Rapid calculates the difference between your server document root and your project's index.php file and defines this as a base path that you do not have to include in your route definitions or redirect calls. Take for example a scenario where your index.php is located at `htdocs/my_ca/`, here Rapid will calculate your base path as `/my_ca`, so your route definitions only need to continue on from this point (e.g. route `/somePath` is known to mean `/my_ca/somePath`).


## Reporting Bugs
To report bugs in the library, report them on the [Issues Page](https://gitlab.comp.dkit.ie/gavins/rapid-starter-project/issues) on GitLab, or email them to **shane.gavin@dkit.ie**.