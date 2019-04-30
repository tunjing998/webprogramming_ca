<?php
use Rapid\ConfigFile;

// Include the Rapid library
require_once('lib/Rapid.php');
DEFINE('BASE_DIR', ConfigFile::getContent()['ENV']);
DEFINE('IMG_DIR', BASE_DIR."/assets/img/productImg/");
// Create a new Router instance
$app = new \Rapid\Router();
// Define some routes. Here: requests to / will be
// processed by the controller at controllers/Home.php
$app->GET('/',        'Home');
$app->GET('/example', 'Example');
$app->GET('/register', 'Register');
$app->GET('/login', 'Login');
$app->GET('/contact', 'Contact');
$app->GET('/order', 'Order');
$app->GET('/account', 'Account');
$app->GET('/product', 'Product');
$app->GET('/logout', 'Logout');
$app->GET('/product/(?<id>[0-9]+)', 'Productdetail');
$app->GET('/order/(?<id>[0-9]+)','Orderdetail');
$app->GET('/review/(?<id>[0-9]+)','Reviewdetail');

$app->GET('/productadmin','Productadmin');
$app->GET('/orderadmin','Orderadmin');
$app->GET('/accountadmin','Accountadmin');
$app->GET('/reviewadmin','Reviewadmin');
$app->GET('/productedit/(?<id>[0-9]+)', 'Productedit');
$app->GET('/accountedit/(?<id>[0-9]+)', 'Accountedit');

$app->POST('/register', 'Register');
$app->POST('/login', 'Login');
$app->POST('/product', 'Product');

$app->POST('/accountedit/(?<id>[0-9]+)', 'Accountedit');
$app->dispatch();
?>