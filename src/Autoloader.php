<?php
namespace Media;

/**
 * 
 */
class Autoloader
{
	
	function __construct()
	{
		// code...
	}

	static function register()
	{
		spl_autoload_register(__CLASS__, 'autoload');
	}

	static function autoload($class)
	{
		if (strpos($class, __NAMESPACE__.'\\') === 0 ) {
			str_replace(__NAMESPACE__.'\\','',$class);
			str_replace('\\','/',$class);
			require $class.'.php';
		}
	}
}
