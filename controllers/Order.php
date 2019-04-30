<?php return function($req, $res) {

if(1==($req->session('id')))
{
    $layout = 'admin';
}else if(null!=($req->session('id')))
{
    $layout = 'login';
}
else
{
  $res->redirect('/');
}
require_once 'models/Order.php';
$orders = Order::findByClientId($req->session('id'));

$res->render($layout, 'order', [
  'page_title' => 'My Order',
  'orders'=>$orders
]);

}
?>