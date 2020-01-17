# PhpApix
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

### Import mysql database
```bash
# create db
mysql -u root -p < sql/phpapix.sql

# cretae db user
mysql -u root -p < sql/user.sql
```

### Create Api controller class path
```bash
mkdir -p src/Api/Sample
```

## Route controller class
nano src/Api/Sample/SampleClass.php
```php
<?php
// Import mysql pdo class
use PhpApix\Mysql\MysqlConnect;

// Import your class
use PhpApix\Api\Sample\Email;

// Class controller
class SampleClass extends MysqlConnect
{
	function Index($router){
		echo "My new page class Index method works!";
		
		try
		{
			// Url parts: 			
			$params = $router->GetParams($_SERVER['REQUEST_URI']);

			// Mysql pdo sample			
			$r = $this->Pdo->prepare("SELECT * FROM users WHERE id != :id");
			$r->execute([':id' => 0]);
			$rows = $r->fetchAll (); // Get rows

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

## Custom class for controller
nano src/Api/Sample/Email.php
```php
<?php
// PhpApix namespace
namespace PhpApix\Api\Sample;

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

## Rotes file
nano router.php
```php
<?php
use PhpApix\Router\Router;

try
{
    // Create router
    $r = new Router();

    // Clear all routes
    $r->Clear();

    /* ROUTES */

    // Home page /index
    $r->Set ("/index", "Api/Home/Home", "Index");

    // Error page /error404
    $r->Set ("/error404", "Api/Error/ErrorPage", "Error404");

    // Add route: url, class path, class method
    $r->Set("/welcome/email/{id}", "Api/Sample/SampleClass", "Index");
    
    // Route with custom method
    // $r->Set ("/user/{userid}/blog", "Api/User/Profil", "Blog");

    /* END ROUTES */

    // Run router
    $r->Init();
}
catch (Exception $e)
{	
    $e->getMessage();
}
?>
```

### Test route
http://localhost/welcome/email/YourUsername
