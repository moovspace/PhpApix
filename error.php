<?php
// Time limit
set_time_limit(0);

// Timezone
date_default_timezone_set('Etc/UTC');

// Errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL & ~E_NOTICE);

// Charset
mb_internal_encoding('UTF-8');
mb_http_output('UTF-8');

// Session
session_start();

// More php setings
// php.user.ini
?>
