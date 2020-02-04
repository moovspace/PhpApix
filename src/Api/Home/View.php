<?php
namespace MyApp\Web\Home;

use PhpApix\Mysql\MysqlConnect;
use PhpApix\Mysql\Db;

class View extends MysqlConnect
{
    // Mysql connetion example
    static function Data(){
        try
		{
            // Mysql from public method (MysqlConnect class)
            // $stm = $this->Pdo->query("SELECT * FROM users");
            // $rows = $stm->fetchAll();
            // return $rows;

            // Mysql from static method with singleton (Db class)
            $db = Db::getInstance();
            return $db->Pdo->query('select * from `users`')->fetchAll();

			// Create mysql database, tables
			// $this->Create();
		}
		catch(Exception $e)
		{
			echo $e->getMessage();
        }
    }

    static function Show($text = 'Hello World')
    {
        // Get data
        // $d = self::Data();
        // print_r($d);

        ?>

        <div class="box">
			<h1> <?php echo $text; ?> </h1>
        </div>

        <?php
    }
}
?>