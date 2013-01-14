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

class agoractu_autoTest extends PHPUnit_Framework_TestCase
{
	public function testAutoloaderReturnsFalseWhenCallingNonExistingClass()
	{
		$this->setExpectedException('Exception');
		agoractu_auto::loader('foo23_bar42');
	}
}
