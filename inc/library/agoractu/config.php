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
 * config
 *
 * provides global access to configuration values
 */
class agoractu_config
{
	/**
	 * configuration
	 *
	 * @access private
	 * @static
	 * @var    array
	 */
	private static $_config = array();

	/**
	 * reads the configuration settings from the given path
	 *
	 * @access public
	 * @static
	 * @param  string $path
	 * @throws Exception
	 * @return void
	 */
	public static function load($path)
	{
		if(!is_dir($path)) {
			throw new Exception('Unable to open configuration directory "' . $path . '".');
		}

		if(!is_readable($path . '/system.ini')) {
			throw new Exception('Unable to read system.ini in "' . $path . '".');
		}
		$system = parse_ini_file($path . '/system.ini', $process_sections = TRUE);

		if(!is_readable($path . '/local.ini')) {
			throw new Exception('Unable to read local.ini in "' . $path . '".');
		}
		$local = parse_ini_file($path . '/local.ini', $process_sections = TRUE);

		self::$_config = array_merge($system, $local);
	}

	/**
	 * gets a configuration section or a single value
	 *
	 * @access public
	 * @static
	 * @param  string $section
	 * @param  string $value
	 * @throws Exception
	 * @return mixed
	 */
	public static function get($section, $value = NULL)
	{
		if(!array_key_exists($section, self::$_config)) {
			throw new Exception('Section "' . $section . '" is not configured.');
		}

		if(empty($value)) {
			return self::$_config[$section];
		} elseif(!array_key_exists($value, self::$_config[$section])) {
			throw new Exception('Configuration value "' . $value . '" not found in section "' . $section . '".');
		} else {
			return self::$_config[$section][$value];
		}
	}
}
