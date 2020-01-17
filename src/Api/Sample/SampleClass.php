<?php
/* Controller class without namespace !!! */

// Import mysql pdo class
use PhpApi\Mysql\MysqlConnect;

// Import your email class
use PhpApi\Api\Sample\Email;

// Class controller
class SampleClass extends MysqlConnect
{
    function Index($router)
    {
        echo "Sample class Index method works!";

        try
        {
            // Url params: /welcome/email => welcome, email
            $params = $router->GetParams($_SERVER['REQUEST_URI']);
            echo '<br>' . ucfirst($params[0]) . ' ' . $params[2];

            // Mysql pdo sample
            $r = $this->Pdo->prepare("SELECT * FROM users WHERE id != :id");
            $r->execute([':id' => 0]);
            $rows = $r->fetchAll (); // Get rows

            echo "<pre>";
            print_r($rows);
            echo "</pre>";

            // Use Your class sample
            $e = new Email();
            $e->Send();
        }
        catch(Exception $e)
        {
                echo $e->getMessage();
        }
    }
}
?>
