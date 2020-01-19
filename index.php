<?php 
// Composer autoload
require("vendor/autoload.php");
// Errors, sessions, ini_set
require("phpini.php");
// Router, routes
require('router.php');

$u = '/user/{id}/blog';

function getParam($id = '{id}', $url, $route){
	$u = explode('/', $url);
	$r = explode('/', $route);
	foreach ($r as $k => $v) {
		if($v == $id){
			return $u[$k];
		}
	}
	return false;
}

// echo getParam('/user/Maxiu/blog', '/user/{id}/blog', '{id}');
?>
