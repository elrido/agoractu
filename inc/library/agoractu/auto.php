<?php
/**
 * AgorActu
 *
 * RSS agregator with anonymous comments
 *
 * @link      https://github.com/rachyandco/agoractu/wiki
 * @copyright 2012 Swiss Pirate Party (www.partipirate.ch)
 * @version   0.1
 */

/**
 * auto
 *
 * provides autoloading functionality
 */
class agoractu_auto
{
	/**
	 * includes class files
	 *
	 * @access public
	 * @static
	 * @param  string $classname
	 * @return mixed
	 */
	public static function loader($classname)
	{
		if(!defined('PATH')) {
			define('PATH', dirname(__FILE__) . '/../../');	// __DIR__ is available in PHP > 5.3, using dirname(__FILE__) workaround to support older PHP versions
		}
		if(strpos($classname, '_') === FALSE) {
			$path = PATH . 'model/' . $classname . '.php';
		} else {
			$path = PATH . 'library/' . str_replace('_', '/', $classname) . '.php';
		}
		if(!$result = @include $path) {
			throw new Exception('Failed to include "' . $path . '", stopping autoloading.');
		}
		return $result;
	}
}
