# PhpApix Composer
See how to add a router to a new project in php.

### Create composer project
```bash
# create dir
mkdir new-app
cd new-app

# create composer.json
composer init
```

### Composer file with your namespace MyApp
nano composer.json
```json
{
    "name": "username/new-app",
    "description": "New app",
    "type": "project",
    "require": {
        "moovspace/phpapix": "^4.0"
    },
    "minimum-stability": "stable",
    "autoload": {
        "psr-4": {
            "MyApp\\": "src/"
        },
        "classmap": [
            "src/"
        ]
    }
}
```

### Composer autoload
``bash
composer update
composer dump-autoload -o
```

### Create router
nano index.php
```php
<?php
// Composer autoload
require("vendor/autoload.php");
// Errors, sessions, ini_set
include("phpini.php");
// Router, routes
require('router.php');
?>
```

### Router file
nano router.php
```php
use PhpApix\Router\Router;

try
{
    $r = new Router();

    /* ROUTES */

    // Home page
    $r->Set("/index", "Api/Home/Home", "Index");

    /* END ROUTES */

    // Show ErrorPage or add yours with include('...')
    $r->ErrorPage();
}
catch(Exception $e)
{
    echo json_encode(["errorMsg" => $e->getMessage(), "errorCode" => $e->getCode()]);
}
?>
```

### Create controller folder
```bash
# src/Path/To/Dir/ClassName.php
mkdir -p src/Api/Home
```

### Create controller Home.php class in dir src/Api/Home
nano src/Api/Home/Home.php
```php
<?php
/* Controller class without namespace !!! */

// Import mysql pdo class from PhpApix
use PhpApix\Mysql\MysqlConnect;

// How to import your class to controller !!!
use MyApp\Api\Home\Html;

// Class controller
class Home extends MysqlConnect
{
    function Index($router)
    {    	
    	Html::Header('Hello from main page | It is title');

    	?>
			<div class="box">
				<h1> Hello from homepage! </h1>
			</div>		
        <?php

        try
		{
			// Mysql query
			// $this->pdo->query("SELECT * FROM ...");
		}
		catch(Exception $e)
		{
			echo $e->getMessage();
		}


        Html::Footer();
    }
}
?>
```

### Create Header class
nano src/Api/Home/Html.php
```php
<?php
/* With your namespace */
namespace MyApp\Api\Home;

class Html
{	
	static function Header($title = 'page title here', $desc = 'Page desc here', $keywords = 'keywords here')
	{
		?>
			<!DOCTYPE html>
			<html lang="pl">
			<head>
				<title> <?php echo $title ?> </title>
				<meta charset="UTF-8">
				<meta http-equiv="X-UA-Compatible" content="ie=edge">
				<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
				<meta name="description" content="<?php echo $desc ?>">
				<meta name="keywords" content="<?php echo $keywords ?>">
				<meta name="author" content="">

				<?php 
					self::Favicon();
					self::Cache();
				?>

				<!-- fonts -->
				<link href="https://fonts.googleapis.com/css?family=Quicksand:300,400,500,600,700,900" rel="stylesheet">
				
				<!-- bootstrap -->
				<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">					
				<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
				<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
				<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

				<!-- Style -->
				<link rel="stylesheet" href="/src/Api/Home/style.css">

				<!-- Script -->
				<script src="/src/Api/Home/main.js"></script>

				<script> 
				$(document).ready(function(){				
					console.log("PhpApix works...");
					console.log(document.cookie);
				});
				</script>

				<style type="text/css">
					
				</style>
			</head>
			<body>
		<?php
	}

	static function Footer()
	{
		?>
			</body>
			</html>
		<?php
	}

	static function Cache(){
		?>
			<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
			<meta http-equiv="Cache-Control" content="post-check=0, pre-check=0">
			<meta http-equiv="Pragma" content="no-cache" />
			<meta http-equiv="Expires" content="0" />
		<?php
	}

	static function Favicon()
	{
		?>
			<link rel="shortcut icon" href="/favicon/favicon.ico" type="image/x-icon">
			<link rel="icon" href="/favicon/favicon.ico" type="image/x-icon">
		<?php
	}
}
?>
```

### Error page in dir
nano src/Api/Error/ErrorPage.php
```php
<?php
namespace MyApp\Api\Error;

// Import your header
use MyApp\Api\Home\Html;

class ErrorPage
{
    static function Error404($router)
    {
		// Include header
		Html::Header();

		?>
			<div class="box">
				<img src="/media/img/phpapix-logo.jpg" width="156" height="156">
				<h1>Error 404! Page not found!</h1>
			</div>
		<?php

		// Include footer
		Html::Footer();
    }
}
?>
```

### Refresh composer vendor autoload
``bash
# remove demo dir from vendor
cd new-app
rm -rf vendor/moovspace/phpapix/Api

# update composer autoload
composer dump-autoload -o
```