<?php return function($req, $res) {

  $res->render('main', 'example', [
    'someLocalKey' => 'Some Local Value'
  ]);

} ?>