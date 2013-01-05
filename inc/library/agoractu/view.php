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
 * view
 *
 * loads and runs the view scripts
 */
class agoractu_view
{
	/**
	 * instance of singleton
	 *
	 * @access private
	 * @static
	 * @var    agoractu_view
	 */
	private static $_instance = NULL;

	/**
	 * path relative to web root
	 *
	 * @access private
	 * @static
	 * @var    string
	 */
	private static $_basePath;

	/**
	 * make constructor private to enforce use of getInstance
	 *
	 * @access private
	 * @return void
	 */
	private function __construct()
	{
	}

	/**
	 * prohibit cloning by making the method private
	 *
	 * @access private
	 * @return void
	 */
	private function __clone()
	{
	}

	/**
	 * includes class files
	 *
	 * @access public
	 * @static
	 * @return agoractu_view
	 */
	public static function getInstance()
	{
		if(NULL === self::$_instance) {
			self::$_instance = new self;
			$path = trim(dirname($_SERVER['PHP_SELF']), '/');
			if('.' == $path) {
				self::$_basePath = '/';
			} else {
				self::$_basePath = '/' . $path . '/';
			}
		}
		return self::$_instance;
	}

	/**
	 * adds header and footer and dispatches a given view
	 *
	 * @access public
	 * @param  string $view
	 * @throws Exception
	 * @return void
	 */
	public function dispatch($view)
	{
		$this->self = $view;
		foreach(array('header', $view, 'footer') as $file) {
			$path = PATH . 'view/' . $file . '.php';
			if(is_readable($path)) {
				include $path;
			} else {
				throw new Exception('File "' . $path . '" not found, stopping view dispatch.');
			}
		}
	}

	/**
	 * turns a path relative to the project root into a path relative to the web root
	 *
	 * @access public
	 * @param  string $path
	 * @return string
	 */
	public function basePath($path = '')
	{
		return self::$_basePath . ltrim($path, '/');
	}
}
