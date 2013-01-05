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
 * controller
 *
 * loads and prepares a controller
 */
class agoractu_controller
{
	/**
	 * produces initialized controller
	 *
	 * @access public
	 * @static
	 * @throws Exception
	 * @return agoractu_controller_abstract
	 */
	public static function factory($type)
	{
		list($controller, $action) = explode('/', $type);
		$path = PATH . 'controller/' . $controller . '.php';
		if(!@include $path) {
			throw new Exception('Failed to include "' . $path . '", stopping controller production.');
		}
		$controllerName = $controller . 'Controller';
		return new $controllerName($action);
	}
}
