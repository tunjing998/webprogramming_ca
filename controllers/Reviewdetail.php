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
  $layout = 'main';
}
require_once 'models/Review.php';

$review = Review::findOneById(intval($req->param('id')));

$res->render($layout, 'reviewdetail', [
  'page_title' => 'Review Details','review'=>$review
]);
}
?>