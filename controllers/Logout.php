<?php return function ($req, $res) {

    $req->sessionDestroy();
    $res->redirect('/');
}
?>