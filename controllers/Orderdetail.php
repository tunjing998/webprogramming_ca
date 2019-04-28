<?php return function($req, $res) {
if(null!=($req->session('id')))
{
    $layout = 'login';
}else
{
    $layout = 'main';
}
require_once 'models/Order.php';

$order = Order::findOrderDetailById(intval($req->param('id')));

$res->render($layout, 'orderdetail', [
  'page_title' => 'Order Details','order'=>$order
]);
}
?>