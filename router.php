<?php
use PhpApix\Router\Router;

try
{
    $r = new Router();

    /* ROUTES */

    // Home page /index , default methods: GET, POST, PUT
    $r->Set("/index", "Api/Home/Home", "Index");

    // Only GET
    $r->Set('/route1', function($p) {
        echo "WORKS WITH GET " . $p[0] . ' ' .$_GET['id'];
    }, ['Param 1'], ['GET']);

    // Only POST, PUT
    $r->Set('/route2', function($p) {
        echo "WORKS WITH POST " . ' ' . implode(' ', $_POST['id']);
    }, 'Func params here', ['POST', 'PUT']);

    // Api route
    $r->Set("/api/user/{id}", "Api/User/User", "GetId");

    // Add route: url, class path, class method
    $r->Set("/welcome/email/{id}", "Api/Sample/SampleClass", "Index");

    // Or load from controller route.php file
    // $r->Include('Api/Sample/route');

    /* END ROUTES */

    // Error Page
    $r->ErrorPage();
}
catch(Exception $e)
{
    echo $e->getMessage();
}
?>