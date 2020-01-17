<?php
namespace PhpApi\Router;
use \Exception;

class Route
{
	public $Hash = '';
	public $Url = '';
	public $Path = '';

	function __construct ($url, $path){
		$this->Hash = md5 ($url);
		$this->Url = $url;
		$this->Path = $path;
	}
}
