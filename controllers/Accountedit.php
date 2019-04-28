<?php return function($req, $res) {
if(1!=($req->session('id')))
{
    $res->redirect('/');
}
require_once 'models/Account.php';
require_once 'models/Client.php';
$account = Account::findOneById(intval($req->param('id')));
$client = Client::findOneById(intval($req->param('id')));
$form_posted = (!$req->body('id') == null);
if($form_posted)
{
    $account->setUsername($req->body('username'));
    $account->setPasscode($req->body('passcode'));
    $client->setNickname($req->body('nickname'));

    if($account->save() && $client->save())
    {
        $res->redirect('/accountadmin');
    }
    else
    {
        $error = 'Not Saved';
    }
}
$res->render('admin', 'accountedit', [
  'page_title' => 'Account Details','account'=>$account,'client'=>$client,'error'=>$error??null
]);
}
?>