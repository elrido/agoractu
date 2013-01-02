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

class agoractu_routerTest extends PHPUnit_Framework_TestCase
{
	public function setUp()
	{
		$_SERVER['SERVER_NAME'] = 'www.example.com';
		$_SERVER['SERVER_PORT'] = 443;
	}

	public function testDispatch()
	{
		$this->assertEquals('article/list', agoractu_router::dispatch());

		$_SERVER['ORIG_PATH_INFO'] = '/feeds';
		$this->assertEquals('feed/list', agoractu_router::dispatch());

		$_SERVER['REQUEST_URI'] = '/';
		$this->assertEquals('article/list', agoractu_router::dispatch());

		$_SERVER['REQUEST_URI'] = '/admin';
		$this->assertEquals('admin/index', agoractu_router::dispatch());

		$_SERVER['REQUEST_URI'] = 'http://host.example.com:1234/feeds';
		$this->assertEquals('feed/list', agoractu_router::dispatch());

		$_SERVER['REQUEST_URI'] = '/some/weird/path/2501';
		$this->assertEquals('', agoractu_router::dispatch());
	}

	public function testRedirect()
	{
		$_SERVER['HTTPS'] = 'off';
		agoractu_router::redirect('/some/path', agoractu_router::STATUS_301);

		$_SERVER['SERVER_PORT'] = 8080;
		agoractu_router::redirect('/other/path', agoractu_router::STATUS_302);
	}
}
