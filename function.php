<?php

define('APP_PATH', __DIR__);

function redirect($url) {
    header("Location: $url");
    exit;
}

function dd($data) {
    var_dump($data);
    exit;
}

function app_path($path = '') {
    return rtrim(APP_PATH . DIRECTORY_SEPARATOR . $path, "\\/");
}

function view_path($path = '') {
    return rtrim(APP_PATH . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . $path, "\\/");
}