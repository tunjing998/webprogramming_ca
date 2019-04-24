<?php return function($req, $res) {
include_once('models/account.php');
$db = require('lib/database.php');
$data = Manager::readAll($db);
$res->render('main', 'account', [
    'pageTitle' => 'account Page!','record'=>$data
]);

} ?>