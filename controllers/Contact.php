<?php return function($req, $res) {

if(null!=($req->session('id')))
{
    $layout = 'login';
}else
{
    $layout = 'main';
}
$res->render($layout, 'contact', [
  'someLocalKey' => 'Some Local Value'
]);
}
?>