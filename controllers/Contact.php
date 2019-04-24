<?php return function($req, $res) {
include_once('models/contact.php');
$db = require('lib/database.php');
$data = Manager::readAll($db);
$res->render('main', 'contact', [
    'pageTitle' => 'contact Page!','record'=>$data
]);

} ?>