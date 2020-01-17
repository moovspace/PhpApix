<?php
require ("error.php");

use PhpApix\Router\Router;

try
{
    // Create router
    $r = new Router();

    // Clear all routes
    $r->Clear();

    // Home page /index
    $r->Set ("/index", "Api/Home/Home", "Index");

    // Error page /error404
    $r->Set ("/error404", "Api/Error/ErrorPage", "Error404");

    // Add route: url, class path, class method
    $r->Set("/welcome/email/{id}", "Api/Sample/SampleClass", "Index");
    
    // Route with custom method
    // $r->Set ("/user/{userid}/blog", "Api/User/Profil", "Blog");

    // Run router
    $r->Init();
}
catch (Exception $e)
{	
    $e->getMessage();
}
?>

