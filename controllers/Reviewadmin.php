<?php return function($req, $res) {

if(1!=($req->session('id')))
{
    $res->redirect('/');
}
require_once 'models/Review.php';
$reviews = Review::findAll();

$res->render('admin', 'reviewadmin', [
  'page_title' => 'Review List','reviews'=>$reviews
]);

}
?>