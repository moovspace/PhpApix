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

## Router and routes
nano router.php
```php
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
        echo "WORKS WITH POST " . ' ' . implode(' ', $_POST);
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
			$m = new PHPMailer(true);
		}
		catch(Exception $e)
		{
		    $e->getMessage();
		}
	}
}
?>
```