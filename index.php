<?php 
// Composer autoload
require("vendor/autoload.php");
// Errors, sessions, ini_set
require("phpini.php");
// Router, routes
require('router.php');

echo ini_get('upload_max_filesize');
?>
