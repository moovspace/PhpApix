<?php
require ("error.php");

use PhpApix\Router\Router;

try
{
    // Create router
    $r = new Router();

    // Clear all routes
    $r->Clear();

    // Home page name: /index
    $r->Set ("/index", "Api/Home/Home", "Index");

    // Add route: (url, class path, class method) default method name: Index
    $r->Set("/welcome/email/{id}", "Api/Sample/SampleClass", "Index");
    
    // $r->Set ("/user/{userid}/blog", "Api/User/Profil", "Blog");

    // Run router
    $r->Init();
}
catch (Exception $e)
{	
    $e->getMessage();
}
?>

