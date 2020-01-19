<?php
// Time limit
set_time_limit(0);

// Timezone
date_default_timezone_set('Etc/UTC');

// Errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL & ~E_NOTICE);

// Session cookie secure, lifetime unlimited
session_set_cookie_params(0, '/', '.'.$_SERVER["HTTP_HOST"], isset($_SERVER["HTTPS"]), true);

// Set secure cookie $_COOKIE uniqueid
setcookie("phpapix", uniqid(), time() + 48 * 60 * 60 , "/", '.'.$_SERVER['HTTP_HOST'], isset($_SERVER["HTTPS"]), true);

// Session start
session_start();

// Charset
mb_internal_encoding('UTF-8');
mb_http_output('UTF-8');

// More php setings
// php.user.ini
?>