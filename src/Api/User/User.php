<?php
/* Controller class without namespace !!! */

// Import mysql pdo class
use PhpApix\Mysql\MysqlConnect;

// Class controller
class User extends MysqlConnect
{
    function GetId($router)
    {
        try
        {
            // User name from url: /api/user/{id}
            $params = $router->GetParams($_SERVER['REQUEST_URI']);
            // {id} part
            $username = $params[2]; 

            // Mysql pdo
            $r = $this->Pdo->prepare("SELECT * FROM users WHERE username = :id");
            $r->execute([':id' => $username]);

            // User id or 0
            $id = (int) $r->fetchAll()[0]['id'];

            if($id == 0){
                $error = 'Error username';
            }

            header('Content-Type: application/json; charset=UTF-8');
            
            return json_encode(['id' => $id, 'error' => $error]);
        }
        catch(Exception $e)
        {
                echo $e->getMessage();
        }
    }
}
?>
