<?php return function($req, $res) {
require_once 'models/Product.php';
if(1==($req->session('id')))
{
    $layout = 'admin';
}else if(null!=($req->session('id')))
{
    $layout = 'login';
}
else
{
  $layout = 'main';
}
$products = Product::findTenByRand();

$res->render($layout, 'home', [
  'page_title' => 'Home Page','products'=>$products
]);

}
?>