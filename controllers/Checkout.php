<?php return function($req, $res) {
$layout=Utils::checkLayout($req->session('id'));
$cart = $req->session('cart');
$res->render($layout, 'checkout', [
  'page_title' => 'Checkout','cart'=>$cart
]);
}
?>