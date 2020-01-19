<?php
namespace PhpApix\Router;
use \Exception;

class Router
{
	protected $Routes = array();
	protected $CurrentRoute = '';

	function __construct()
	{		
		if(!empty($_SESSION['PhpApixRoutes'])){
			$this->Routes = $_SESSION['PhpApixRoutes'];
		}
	}

	function Hash($url)
	{
		return md5 ($url);
	}

	function Set($url, $path, $method)
	{
		if (empty ($this->Routes)){
			$this->Routes = [];
		}

		$hash = $this->Hash ($url);

		if (!array_key_exists ($hash, $this->Routes)) {
			$this->Routes[$hash] = [$url, $path, $method];
			$this->Save (); // Save routes to session
		}else{
			throw new Exception ("Duplicate routes! Route with this url " . $url . " exists.", 1);
		}
	}

	function Get()
	{
		return $this->Routes;
	}

	function ErrorPage()
	{
		ob_end_clean();
		header("Location: /error404");
		ob_flush();
	}

	function Init()
	{
		// Load class
		$hash = $this->GetRoute();

		if(empty($hash)){
			$this->ErrorPage();			
		}else{
			$p = $this->Routes[$hash][1]; // Class path
			$m = $this->Routes[$hash][2]; // Method
			$str = explode ('/', $p);
			$c = end ($str); // Class name
			$f = "src/" . ltrim($p,'/') . ".php";

			if(file_exists($f)){
				// Include class
				require ($f);

				// Create class object
				$obj = new $c();

				// Run method
				if(method_exists($obj, $m)){
					echo $obj->$m($this);
				}else{
					throw new Exception("Create new controller (".$p.") method: " . $m, 2);
				}
			}else{
				throw new Exception("Create new controller file: " . $f, 1);
			}
		}
	}

	function Save()
	{
		if(!empty($this->Routes)){
			$_SESSION['Routes'] = $this->Routes;
		}
	}

	function Clear()
	{
		unset ($_SESSION['Routes']);
		unset ($this->Routes);
		$this->Save ();
	}

	/**
	 * GetRoute class
	 * get routes array hash
	 * @return string 	Routes array key (hash)
	 */
	function GetRoute()
	{
		// Current url
		$url = $this->GetUrl($_SERVER['REQUEST_URI']);		

		$url = trim($url);		
		$url = rtrim($url, '/');
		if(empty($url) || $url == '/' || $url == '/index.php'){ 
			$url = '/index'; 
		}

		foreach ($this->Routes as $k => $v)
		{
			$route_path = $v[0]; // each url			

			// Replace {slug} from url
			$regex = preg_replace('/\{(.*?)\}/','[a-zA-z0-9_.-]+',$route_path);
			$regex = str_replace("/", "\/", $regex);

			// if url match route->path
			if(preg_match('/^'.$regex.'[\/]{0,1}$/', $url)){
				// Set route
				$this->CurrentRoute = $route_path;
				// Return route hash
				return $k;
			}
		}
	}

	function getParam($id = '{id}'){
		if(!empty($this->CurrentRoute)){
			$u = explode('/', $this->GetUrl($_SERVER['REQUEST_URI']));
			$r = explode('/', $this->CurrentRoute);
			foreach ($r as $k => $v) {
				if($v == $id){
					return $u[$k];
				}
			}
		}
	}

	function GetUrl($url){
		return $this->Url = parse_url($url, PHP_URL_PATH);
	}

	function GetUrlQuery($url){
		$str = parse_url($url, PHP_URL_QUERY);
		parse_str($str, $this->UrlQuery);
		return $this->UrlQuery;
	}

	function GetParams($url){
		$url = $this->GetUrl ($url);
		$url = $this->ClearUrl ($url);
		return $this->Params = explode('/', $url);
	}

	function ClearUrl($url)
	{
		$url = trim($url);
		$url = rtrim($url, '/');
		return ltrim($url, '/');
	}
}

?>
