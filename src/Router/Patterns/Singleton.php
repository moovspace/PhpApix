<?php 
declare(strict_types=1);

namespace PhpApix\Router\Patterns;

final class Singleton
{
	// private static $instance = null;

	/**
	 * Gets the instance
	 */
	public static function getInstance(): self
	{
		static $instance;

		if (null === $instance) {
			$instance = new self();
			// static::$instance = new self();
		}

		return $instance;
	}

	/**
	 * Is not allowed to call from outside to prevent from creating multiple instances,
	 * to use the singleton, you have to obtain the instance from Singleton::getInstance() instead
	 * protected or private
	 */
	protected function __construct()
	{
	}

	/**
	 * prevent the instance from being cloned (which would create a second instance of it)
	 * protected or private
	 */
	protected function __clone()
	{
	}

	/**
	 * prevent from being unserialized (which would create a second instance of it)
	 * protected or private
	 */
	protected function __wakeup()
	{
	}
}
?>
