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
 * router
 *
 * routes requests to the right view
 */
class agoractu_router
{
	/**
	 * URI to redirect to, when the requested URI was not found
	 *
	 * @access private
	 * @static
	 * @var    string
	 */
	private static $_defaultUri = '/';

	/**
	 * HTTP 301 status
	 *
	 * @const  string
	 */
	const STATUS_301 = '301 Moved Permanently';

	/**
	 * HTTP 302 status
	 *
	 * @const  string
	 */
	const STATUS_302 = '302 Moved Temporarily';

	/**
	 * handles the request and returns "controller/action"
	 *
	 * @access public
	 * @static
	 * @return string
	 */
	public static function dispatch()
	{
		if(array_key_exists('REQUEST_URI', $_SERVER)) {
			// most setups provide REQUEST_URI, remove hostname and params if necessary
			$path = preg_replace(
				array('#^[^/:]+://[^/]+#', '#\?[^?]+$#'),
				'',
				$_SERVER['REQUEST_URI']
			);
		} elseif(array_key_exists('ORIG_PATH_INFO', $_SERVER)) {
			// some CGI setups provide this
			$path = $_SERVER['ORIG_PATH_INFO'];
		} else {
			// maybe you use IIS or something exotic as a server?
			// Sorry, you will only get the root element for now.
			// Please file a bug so we can help you fix this, thx.
			$path = self::$_defaultUri;
		}

		try {
			$controller_action = agoractu_config::get('routing', $path);
		} catch (Exception $e) {
			// not found, temporarily redirect to default URI
			self::redirect(self::$_defaultUri);
			return '';
		}
		return $controller_action;
	}

	/**
	 * replies with HTTP headers for redirecting the client
	 *
	 * @access public
	 * @static
	 * @param  string $path   where to point the client to
	 * @param  string $status contains the status to print in the HTTP header
	 * @return void
	 */
	public static function redirect($path, $status = self::STATUS_302){
		if(
			!empty($_SERVER['HTTPS']) &&   // most setups
			$_SERVER['HTTPS'] !== 'off' || // IIS, when not HTTPS
			$_SERVER['SERVER_PORT'] == 443 // some CGI setups
		) {
			$scheme = 'https://';
		} else {
			$scheme = 'http://';
		}

		$authority = $_SERVER['SERVER_NAME'];

		if(!in_array($_SERVER['SERVER_PORT'], array(80, 443))) {
			$authority .= ':' . $_SERVER['SERVER_PORT'];
		}

		header('HTTP/1.1 ' . $status);
		header('Location:' . $scheme . $authority . $path);
	}
}
