<?php return function($req, $res) {

if(null==($req->session('id')))
{
    $res->redirect('/');
}
require_once 'models/Account.php';
require_once 'models/Client.php';
$account = Account::findOneById($req->session('id'));
$client  = Client::findOneById($req->session('id'));
$res->render('login', 'account', [
  'page_title' => 'My Account','account'=>$account,'client'=>$client
]);
}
?>