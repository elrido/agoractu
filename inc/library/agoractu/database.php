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
 * database
 *
 * handles the database connection
 */
class agoractu_database
{
	/**
	 * instance of singleton
	 *
	 * @access private
	 * @static
	 * @var    agoractu_database
	 */
	private static $_instance = NULL;

	/**
	 * instance of database connection
	 *
	 * @access private
	 * @static
	 * @var    PDO
	 */
	private static $_db = NULL;

	/**
	 * database table prefix
	 *
	 * @access private
	 * @static
	 * @var    string
	 */
	private static $_prefix = '';

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
	 * returns a singular database connection
	 *
	 * @access public
	 * @static
	 * @return agoractu_database
	 */
	public static function getInstance()
	{
		if(NULL === self::$_instance) {
			$options = agoractu_config::get('database');

			// set table prefix if given
			if(array_key_exists('tbl', $options)) {
				self::$_prefix = $options['tbl'];
			}

			// initialize the db connection with given options
			if(
				array_key_exists('dsn', $options) &&
				array_key_exists('usr', $options) &&
				array_key_exists('pwd', $options) &&
				array_key_exists('opt', $options)
			) {
				self::$_db = new PDO(
					$options['dsn'],
					$options['usr'],
					$options['pwd'],
					$options['opt']
				);
			} else {
				throw new Exception('One of the options "dsn", "usr", "pwd" and/or "opt" is missing in your database configuration. Please review your "local.ini" file.');
			}
		}
		return self::$_instance;
	}

	/**
	 * gets the database connection
	 *
	 * @access public
	 * @return PDO
	 */
	public function getDb()
	{
		return self::$_db;
	}

	/**
	 * gets the database table prefix
	 *
	 * @access public
	 * @return string
	 */
	public function getPrefix()
	{
		return self::$_prefix;
	}
}
