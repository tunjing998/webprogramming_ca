<?php return function($req, $res) {
if(null!=($req->session('id')))
{
    $layout = 'login';
}else
{
    $layout = 'main';
}
require_once 'models/Product.php';
if(null==$req->query('search'))
{
  $product = Product::find25();
}
else
{
  $product = Product::findByName($req->query('search'));
}
$res->render($layout, 'product', [
  'page_title' => 'Products','products'=>$product
]);
}
?>