<?php
/* Controller class without namespace !!! */

// Import mysql pdo class
use PhpApix\Mysql\MysqlConnect;

// Import your email class
use PhpApix\Api\Sample\Email;

// Import html header, body
use PhpApix\Api\Home\Html;

// Class controller
class SampleClass extends MysqlConnect
{
    function Index($router)
    {
        try
        {
            // Include header
            Html::Header();

            echo '<div class="box">';
            
                echo '<h2>SampleClass works!</h2>';
                // Url params: /welcome/email => welcome, email
                $params = $router->GetParams($_SERVER['REQUEST_URI']);
                echo '<br>' . ucfirst($params[0]) . ' ' . $params[2];


                echo '<h2>Database works!</h2>';
                echo '<div class="box">';
                // Mysql pdo sample
                $r = $this->Pdo->prepare("SELECT * FROM users WHERE id != :id LIMIT 5");
                $r->execute([':id' => 0]);
                $rows = $r->fetchAll(); // Get rows                        
                foreach ($rows[0] as $key => $value) {
                    echo '<div class="list-box"> <bold>'.$key.'</bold> '.$value.'</div>';
                }
                echo '</div>';
                

                echo '<h2>Custom Email class works!</h2>';            
                // Use Your class sample
                $e = new Email();
                $e->Send();

            echo '</div>';

            // Include footer
            Html::Footer();
        }
        catch(Exception $e)
        {
                echo $e->getMessage();
        }
    }
}
?>
