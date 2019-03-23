# Rapid PHP MVC Framework
This is the **Rapid** PHP MVC framework created for GD2/CO2a Web Development (2018/19) CA3 and CA4. This version has no in-built support or helpers for Models, so it is really just a VC framework at this point (you'll have to add model support yourself).

On this page:

* [Getting Started](#getting-started)
* [New in Version 0.2.0 (CA4)](#new-in-version-020-ca4-starter-code)
* [Working with the Router](#working-with-the-router)
* [Working with Controllers](#working-with-controllers)
  * [The `Request` Object](#the-request-object)
  * [The `Response` Object](#the-response-object)
* [Working with Templates](#working-with-templates)
* [Example Controller Flow (Some Pseudo-code)](#example-controller-flow-some-pseudo-code)
* [Exception Handling](#exception-handling)
* [Config File Helper](#config-file-helper)
* [Database PDO Helper](#database-pdo-helper)
* [Base Path](#base-path)
* [Reporting Bugs](#reporting-bugs)


## Getting Started
1. One team member should **Fork** this repository using their online GIT repository hosting provider of choice, as discussed in class. This team member should then ensure all other team members have full access to the repository.
2. Each team member should then **clone** the repository to their local machine to begin work
3. Each team member (on their local machine) should copy `config.php.sample` to `config.php` (note that this is gitignored -- it should **not** be included in your repository).
4. At this point, each team member should create a new **branch** for the first feature they will be working on.
5. Each team member should remember to **push** their local branches to the remote (branch of the same name) as they would normally push if they were working on the master branch.
6. Individual branches should be periodically **merge**d into master
7. Whenever the previous action (6) occurs, each team member should **merge** the remote master branch into their local working branches.
8. Initial actions for team members, after they have branched, should include:
  * Replace the contents of this README with headings for your own README content
  * Edit the project `.htaccess` file to reflect the new location for the rewrite rule
  * **Remove any files which you don't need for your project** (the example controllers, etc.)

Additional notes:

* It would likely be helpful to add an SQL seed file to your repository
* Any team member working on the master branch should be considered a mortal sin. The master branch should only be used to combine (merge) the work that has been done in other branches


## New in Version 0.2.0 (CA4 Starter Code)
* Adds [`\Rapid\ConfigFile::getContent()`](#config-file-helper) helper
* Adds [`\Rapid\Database::getPDO()`](#database-pdo-helper) helper
* Adds `json()` method to the [`Response Object`](#he-response-object)
* Adds `sessionStart()` method to the [`Request Object`](#he-request-object)
* Adds `sessionDestroy()` method to the [`Request Object`](#he-request-object)
* Adds `session()` method to the [`Request Object`](#he-request-object)
* Adds `sessionSet()` method to the [`Request Object`](#he-request-object)

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
`sessionStart()`           | Ensure sessions for the current request; this will restore an existing session, or create new one if needed
`sessionDestroy()`         | Destroys all data associated with a current session
`session($name)`           | Get a single, named session ($_SESSION) value, or `NULL` if the value does not exist (Note: does not exist !== is empty). Ensures the session has been started before attempting retrieval.
`sessionSet($name, $value)`| Set a single, named session ($_SESSION) value. Ensures the session has been started before attempting to set.

### The `Response` Object
Provides methods for formulating a response to a user's request:

Method                     | Description
---------------------------|---------------------------------------
`currentState()`           | Returns all of the object's internal tracking values (headers buffered, status, is the response finished or not)
`status($status)`          | Set the response status code (e.g. `200`)
`header($key,$value)`      | Set a single, named header for the response. E.g. `header('Content-Type', 'text/html')`
`end()`                    | Mark the response as finished. Any attempt to modify the response after this will throw an exception
`send($content)`           | The status code will be set; all buffered headers will be set; the specified content (body) will be sent; the response will be marked finished. Send is publicly visible in case it may be needed, but as a general rule should not be used: favour the use of `render` or `json` instead.
`render(...)`              | See section on working with templates
`json($content)`           | Use for rendering JSON content, instead of a template. This method sets appropriate headers (content type), and encodes the passed value as JSON
`redirect($url)`           | Redirect the user to a different route. This will redirect the user, and kill the current script. This method is base path aware.


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
`ConfigFileNotFoundException`     | Thrown when a config file is not in the expected location, when using the Rapid config file helper
`ConfigPDOKeysMissingException`   | Thrown when a config file contain needed database config values, when using the Rapid database pdo helper

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


## Config File Helper
Version 0.2.0 of this library includes a utility for loading your config file contents. For this to work, your config file must be located at: `[project root]/config.php` (i.e. adjacent to index.php). If the config file cannot be loaded, a `\Rapid\ConfigFileNotFoundException` will be thrown.

The loading of this file is cached, so you can call the content loader, as shown below, as many times as you need to without a performance penalty -- the first time you call it, the config file will be loaded and cached by rapid. On subsequent calls, the content will be returned for Rapid's cache.

Using the helper in a controller:

```php
<?php return function($req, $res) {

  $config = \Rapid\ConfigFile::getContent();

  echo $config['someConfigFileValue'];

} ?>
```

## Database PDO Helper
Version 0.2.0 of this library includes a utility for generating a reusable PDO object for database interactions. For this to work, your config file must be located at: `[project root]/config.php` and contain the following keys:

config.php:
```php
<?php return [

  'DATABASE_HOST' => '127.0.0.1',
  'DATABASE_USER' => 'me',
  'DATABASE_PASS' => 'superSecret',
  'DATABASE_NAME' => 'myDatabase'

] ?>
```

using this helper, a reusable PDO object will created and returned on each subsequent use, so you can call the helper, as shown below, as many times as you need to without a performance penalty -- the first time you call it, The PDO object will be created. On subsequent calls, the object will be returned for Rapid's cache.

Using the helper in a controller:

```php
<?php return function($req, $res) {

  $pdo = \Rapid\Database::getPDO();

} ?>
```

## Base Path
To make your code as portable as possible, Rapid calculates the difference between your server document root and your project's index.php file and defines this as a base path that you do not have to include in your route definitions or redirect calls. Take for example a scenario where your index.php is located at `htdocs/my_ca/`, here Rapid will calculate your base path as `/my_ca`, so your route definitions only need to continue on from this point (e.g. route `/somePath` is known to mean `/my_ca/somePath`).


## Reporting Bugs
To report bugs in the library, report them on the [Issues Page](https://gitlab.comp.dkit.ie/gavins/rapid-starter-project/issues) on GitLab, or email them to **shane.gavin@dkit.ie**.