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
 * controller abstract
 *
 * template for all controllers
 */
abstract class agoractu_controller_abstract
{
	/**
	 * default action to run
	 *
	 * @access private
	 * @var    string
	 */
	private $_action;

	/**
	 * initialize the default action
	 *
	 * @access public
	 * @throws Exception
	 * @return void
	 */
	public function __construct($action)
	{
		$action .= 'Action';
		if(method_exists($this, $action)) {
			$this->_action = $action;
		} else {
			throw new Exception('Method "' . $action . '" does not exist in class ' . __CLASS__ . '.');
		}
	}

	/**
	 * runs the action defined during construction
	 *
	 * @access public
	 * @return void
	 */
	public function dispatch()
	{
		$this->{$this->_action}();
	}
}
