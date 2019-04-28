<?php return function($req, $res) {

if(1!=($req->session('id')))
{
    $res->redirect('/');
}
require_once 'models/Product.php';
$products = Product::findAll();

$res->render('admin', 'productadmin', [
  'page_title' => 'Product','products'=>$products
]);

}
?>