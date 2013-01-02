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

error_reporting( E_ALL | E_STRICT );
require '../library/agoractu/auto.php';
spl_autoload_register('agoractu_auto::loader');
agoractu_config::load('configuration');
