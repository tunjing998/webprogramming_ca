<?php return function($req, $res) {
if(1!=($req->session('id')))
{
    $res->redirect('/');
}
require_once 'models/Product.php';

$product = Product::findOneById(intval($req->param('id')));
$product->delete();
$res->redirect("/productadmin");
}
?>