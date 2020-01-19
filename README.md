# PhpApix
Php api router with composer autoload. See how to build a server side api routing system in PHP.

### Clone or download latest release ***(install git, lamp or lemp server)***
```bash
# install git
sudo apt install git php-mbstring php-curl curl

# clone phpapix repo
git clone --depth=1 https://github.com/moovspace/phpapix
```

### Create class autoloader ***(install composer)***
```bash
cd phpapix
composer update
composer dump-autoload -o
```

### Import mysql database ***(vps)***
Vps server, desktop
```bash
# create db
mysql -u root -p < sql/phpapix.sql

# create db user
mysql -u root -p < sql/user.sql

# dir permissions (only vps linux)
chmod -R 775 /path/to/phpapix
# apache2
chown -R www-data:youruser /path/to/phpapix
# nginx
chown -R nginx:youruser /path/to/phpapix
```

### PhpApix config file: mysql, smtp ***(hosting)***
Hosting with custom mysql database
```bash
nano src/Settings/Config.php
```

### Test api
 - http://localhost/api/user/admin
 - http://localhost/welcome/email/YourUsername


# Api controller class examples in src/Api
```bash
# create dir
mkdir -p src/Api/Sample
```

## Route controller class ***(without namespace)***
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
	function Index($router)
	{
		echo "Hello from SampleClass !!!";
		
		try
		{
			// Url parts			
			$params = $router->GetParams($_SERVER['REQUEST_URI']);

			// Url param with route {id}
			$id = $router->getParam('{id}');            

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

## Custom class for controller ***(with namespace)***
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
	function Send()
	{
		echo "Send email here ...";

		try
		{
			// PhpMailer
			// $m = new PHPMailer(true);
		}
		catch(Exception $e)
		{	
		    $e->getMessage();
		}
	}
}
?>
```

## Api router and routes
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
    $r->Set("/index", "Api/Home/Home", "Index");

    // Error page /error404
    $r->Set("/error404", "Api/Error/ErrorPage", "Error404");

    // Json api route
    $r->Set("/api/user/{id}", "Api/User/User", "GetId");

    // Add route: url, class path, class method
    $r->Set("/welcome/email/{id}", "Api/Sample/SampleClass", "Index");

    // Or load from controller route file
    include('src/Api/Sample/route.php');

    /* END ROUTES */

    // Run router
    $r->Init();
}
catch(Exception $e)
{	
    $e->getMessage();
}
?>
```