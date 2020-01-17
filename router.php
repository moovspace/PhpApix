<?php
require ("error.php");

use PhpApi\Router\Router;

try
{
    // Create router
    $r = new Router();

    // Clear all routes
    $r->Clear();

    // Add routes
	$r->Set("/welcome/email/{id}", "Api/Sample/SampleClass", "Index");
    
    // $r->Set ("/about", "Api/About", "Index");
    // $r->Set ("/user/{userid}/blog", "Api/User/Profil", "Blog");

    // Run router
    $r->Init();
}
catch (Exception $e)
{	
    $e->getMessage();
}
?>

