<?php return function($req, $res) {

  $res->status(501);
  $res->send('<p>The Home controller has not yet been implement. This is just a test.</p>');

} ?>