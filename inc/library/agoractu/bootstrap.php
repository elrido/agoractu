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
 * bootstrap
 *
 * initialises environment and starts a controller
 */
class agoractu_bootstrap
{
	/**
	 * starts AgorActu
	 *
	 * @access public
	 * @param  string $classname
	 * @return mixed
	 */
	public function __construct()
	{
		try {
			require PATH . 'library/agoractu/auto.php';
			spl_autoload_register('agoractu_auto::loader');
			agoractu_config::load(PATH . 'configuration');
			$run = agoractu_router::dispatch();
			if(!empty($run)) {
				agoractu_controller::factory($run)->dispatch();
				agoractu_view::getInstance()->dispatch($run);
			}
		} catch (Exception $e) {
			// TODO catch unhandled exceptions, log them and show the user a generic error page
		}
	}
}
