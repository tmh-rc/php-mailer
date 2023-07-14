<?php

define('APP_PATH', __DIR__);

if(! function_exists('redirect')) {
    function redirect($url) {
        header("Location: $url");
        exit;
    }
}

if(! function_exists('dd')) {
    function dd($data)
    {
        var_dump($data);
        exit;
    }
}

if(! function_exists('app_path')) {
    function app_path($path = '')
    {
        return rtrim(APP_PATH . DIRECTORY_SEPARATOR . $path, "\\/");
    }
}

if(! function_exists('view_path')) {
    function view_path($path = '')
    {
        return rtrim(APP_PATH . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . $path, "\\/");
    }
}