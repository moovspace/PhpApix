<?php
/* Controller class without namespace !!! */

// Import mysql pdo class
use PhpApix\Mysql\MysqlConnect;

// Class controller
class Home extends MysqlConnect
{
    function Index($router)
    {
        echo '<h1>PhpApix - Php api router with composer autoload</h1>';
        echo '<a href="/welcome/email/UserName"> Sample route </a>';
    }
}
?>
