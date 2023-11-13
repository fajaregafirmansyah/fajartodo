<?php

namespace Todo;

class Config {
    const DB_HOST = 'localhost';
    const DB_USER = 'root';
    const DB_PASS = '';
    const DB_NAME = 'fajar_todo';
}
    //  DB PARAM
    define('DB_HOST', 'localhost');
    define('DB_USER', 'root');
    define('DB_PASS', '');
    define('DB_NAME', 'fajar_todo');
    
    // APP ROOT
    define('APPROOT', dirname(dirname(__FILE__)));

    // URL ROOT
    define('URLROOT', 'https://'.$_SERVER['SERVER_NAME']);

    // URL UPLOAD Asset
    define('DIR_ASSET_UPLOAD', 'https://'.$_SERVER['SERVER_NAME'].'/asset/uploads/');
    define('UPLOAD_DIR', '\asset\uploads\\');

    // SITE NAME
    define('SITENAME', 'Fajar Todo');

    // APP VERSION
    define('APPVERSION', '0.0.1');