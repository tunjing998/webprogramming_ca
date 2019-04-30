<?php return function ($req, $res) {

    require_once 'models/Account.php';
    require_once 'models/Client.php';
    $account = Account::findOneById(intval($req->param('id')));
    $client = Client::findOneById(intval($req->param('id')));
    $form_posted = (!$req->body('id') == null);
    if ($form_posted) {

        $client->setNickname($req->body('nickname'));
        if ($client->save()) {
            $res->redirect('/accountadmin');
        } else {
            $error = 'Not Saved';
        }
    }
    $res->render('admin', 'accountedit', [
        'page_title' => 'Account Details', 'account' => $account, 'client' => $client, 'error' => $error ?? null
    ]);
}
?>