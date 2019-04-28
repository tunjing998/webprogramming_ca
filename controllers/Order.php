<?php return function($req, $res) {

if(null==($req->session('id')))
{
    $res->redirect('/');
}
require_once 'models/Order.php';
$orders = Order::findByClientId($req->session('id'));

$res->render('login', 'order', [
  'page_title' => 'My Order',
  'orders'=>$orders
]);

}
?>