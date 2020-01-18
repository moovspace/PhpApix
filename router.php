<?php
use PhpApix\Router\Router;

try
{
    $r = new Router();
    $r->Clear();

    /* ROUTES */

    // Home page /index
    $r->Set("/index", "Api/Home/Home", "Index");    

    // Error page /error404
    $r->Set("/error404", "Api/Error/ErrorPage", "Error404");

    // Api route
    $r->Set("/api/user/{id}", "Api/User/User", "GetId");

    // Add route: url, class path, class method
    $r->Set("/welcome/email/{id}", "Api/Sample/SampleClass", "Index");

    /* END ROUTES */
    
    $r->Init();
}
catch(Exception $e)
{
    echo $e->getMessage();
}
?>