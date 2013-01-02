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

class agoractu_configTest extends PHPUnit_Framework_TestCase
{
	public function testLoadConfiguration()
	{
		agoractu_config::load(PATH . 'test/configuration');
	}

	public function testLoadInvalidConfiguration()
	{
		$this->setExpectedException('Exception');
		agoractu_config::load('invalid/path');
	}

	public function testGetSection()
	{
		$this->assertArrayHasKey('/', agoractu_config::get('routing'));
	}

	public function testGetValue()
	{
		$this->assertEquals('article/list', agoractu_config::get('routing', '/'));
	}

	public function testGetInvalidValue()
	{
		$this->setExpectedException('Exception');
		agoractu_config::get('routing', '/some/weird/path/2501');
	}

	public function testGetInvalidSection()
	{
		$this->setExpectedException('Exception');
		agoractu_config::get('invalid42');
	}
}
