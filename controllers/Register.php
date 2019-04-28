<?php return function ($req, $res) {
    require_once 'models/Account.php';
    $args = [
        'username' => $req->body('username'),
        'email'   => $req->body('email'),
        'passcode' => $req->body('passcode')
    ];
    $form_posted = (!$args['username'] == null);
    if ($form_posted) {
        require_once 'models/Account.php';
        $success = false;
        if ($req->body('passcode') === $req->body('passcodeConfirm')) {
            $account = new Account($args);
            $success = $account->save();
        }
        if ($success) {
            $res->redirect('/');
        } else {
            $args['error'] = 'Username or Email had been used';
        }
    }
    $res->render('main', 'register_form', $args);
}
?>