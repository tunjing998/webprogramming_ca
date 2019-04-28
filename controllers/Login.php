<?php return function ($req, $res) {
    // require_once 'models/Account.php';
    // $success = false;
    // $success = Account::login($req->body('username'), $req->body('password'));
    // echo $success;
    $req->sessionSet('id',$req->body('id'));
    $res->redirect('/');
}
?>