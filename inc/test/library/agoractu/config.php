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

	public function testLoadMissingConfigurationDirectory()
	{
		$this->setExpectedException('Exception');
		agoractu_config::load('invalid/path');
	}

	public function testLoadMissingConfigurationFiles()
	{
		$this->setExpectedException('Exception');
		agoractu_config::load('library');
	}

	public function testGetSection()
	{
		$this->assertTrue(agoractu_config::exists('routing'));
		$this->assertArrayHasKey('/', agoractu_config::get('routing'));
	}

	public function testGetValue()
	{
		$this->assertTrue(agoractu_config::exists('routing', '/'));
		$this->assertEquals('article/list', agoractu_config::get('routing', '/'));
	}

	public function testGetInvalidValue()
	{
		$this->assertFalse(agoractu_config::exists('routing', '/some/weird/path/2501'));
		$this->setExpectedException('Exception');
		agoractu_config::get('routing', '/some/weird/path/2501');
	}

	public function testGetInvalidSection()
	{
		$this->assertFalse(agoractu_config::exists('invalid42'));
		$this->setExpectedException('Exception');
		agoractu_config::get('invalid42');
	}
}
