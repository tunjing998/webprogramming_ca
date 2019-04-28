<?php return function($req, $res) {

if(1!=($req->session('id')))
{
    $res->redirect('/');
}
require_once 'models/Client.php';
$clients = Client::findAll();
$res->render('admin', 'accountadmin', [
  'page_title' => 'Clients List','clients'=>$clients
]);

}
?>