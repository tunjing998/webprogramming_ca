<?php return function($req, $res) {

if(null!=($req->session('id')))
{
    $layout = 'login';
}else
{
    $layout = 'main';
}
require_once 'models/Product.php';
require_once 'models/Review.php';

$product = Product::findOneById(intval($req->param('id')));
$review = Review::findByProductId($product->getProductId());
$res->render($layout, 'productdetail', [
  'page_title' => 'ProductDetails','product'=>$product,'review'=>$review
]);
}
?>