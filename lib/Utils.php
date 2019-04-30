<?php
class Utils
{
    public static function checkLayout($id)
    {
        if (1 == ($id)) {
            $layout = 'admin';
        } else if (null != ($id)) {
            $layout = 'login';
        } else {
            $layout = 'main';
        }
        return $layout;
    }
}
