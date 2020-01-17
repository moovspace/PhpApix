# PhpApi
Php api router class

### Clone repo or download last release
```bash
git clone --depth=1 https://github.com/moovspace/phpapix
```

### Create autoload in project folder
```bash
cd phpapix
composer update
composer dump-autoload -o
```

### Create Api controller class path
```bash
mkdir -p src/Api/Sample
```

# Create Controller Class
nano src/Api/Sample/SampleClass.php
```php
<?php
// Import mysql pdo class
use PhpApi\Mysql\MysqlConnect;

// Import your class
use PhpApi\Api\Sample\Email;

// Class controller
class SampleClass extends MysqlConnect
{
	function Index($router){
		echo "My new page class Index method works!";
		
		try
		{
			// Url params: /welcome/email => welcome, email
			$params = $router->GetParams($_SERVER['REQUEST_URI']);

			// Mysql pdo sample
			// $r = $this->Pdo->prepare($sql);
			// $r->execute($arr);

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
```

### Create send email class for controller
nano src/Api/Sample/Email.php
```php
<?php
// PhpApi namespace
namespace PhpApi\Api\Sample;

// Import classes
use \Exception;

// Import external composer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

class Email
{
	function Send(){		
		echo "Send email here ...";

		// PhpMailer
		// $m = new PHPMailer(true);
	}
}
?>
```

### Add new route
nano router.php
```php
$r->Set ("/welcome/email", "Api/Sample/SampleClass", "Index");
```
