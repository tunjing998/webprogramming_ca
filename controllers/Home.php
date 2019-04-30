<?php return function($req, $res) {
require_once 'models/Product.php';
$layout=Utils::checkLayout($req->session('id'));

$products = Product::findTenByRand();

$res->render($layout, 'home', [
  'page_title' => 'Home Page','products'=>$products
]);

}
?>