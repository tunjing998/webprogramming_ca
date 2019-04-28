<?php return function($req, $res) {

if(1!=($req->session('id')))
{
    $res->redirect('/');
}
require_once 'models/Order.php';
$orders = Order::findAll();

$res->render('admin', 'orderadmin', [
  'page_title' => 'Order','orders'=>$orders
]);

}
?>