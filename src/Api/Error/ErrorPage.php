<?php
class ErrorPage
{
    function Error404($router)
    {
        echo '<h1>Error 404! Page not found!</h1>';
    }

    function Error500($router)
    {
        echo '<h1>Error 500! Internal server error!</h1>';
    }
}
?>