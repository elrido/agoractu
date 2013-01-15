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
 * database abstract
 *
 * template for all database tables, for use in models
 */
abstract class agoractu_database_abstract
{
	/**
	 * data of this object
	 *
	 * @access protected
	 * @var    array
	 */
	protected $_data = array();

	/**
	 * database object
	 *
	 * @access protected
	 * @var    agoractu_database
	 */
	protected $_db = NULL;

	/**
	 * database table rows
	 *
	 * @access protected
	 * @var    array
	 */
	protected $_rows = array(
		'id' => 'BIGINT(20) NOT NULL PRIMARY KEY',
	);

	/**
	 * database table name
	 *
	 * @access protected
	 * @var    string
	 */
	protected $_table = '';

	/**
	 * initialize the default action
	 *
	 * @access public
	 * @throws Exception
	 * @return void
	 */
	public function __construct()
	{
		// database table must not be an empty string
		if(!strlen($this->_table)) {
			throw new Exception('Undefined database table name $_table in class "' . __CLASS__ . '".');
		}

		// prepare data array
		$this->_data = array_fill_keys(array_keys($this->_rows), NULL);

		// the database connection could be overwritten in the concrete class
		if(NULL === $this->_db) {
			$this->_db = agoractu_database::getInstance();
			$this->_table = $this->_db->getPrefix() . $this->_table;
		}

		// check if the database table exists and create it, if necessary
		$this->tableExists(TRUE);
	}

	/**
	 * creates the database table
	 *
	 * @access protected
	 * @param  string $type
	 * @return void
	 */
	protected function _createTable($type = 'mysql')
	{
		$db = $this->getDb();
		$sql = 'CREATE TABLE ' . $this->getTable() . ' (';
		$keys = '';
		foreach($this->_rows as $row => $definition) {
			if('mysql' == $type) {
				foreach(array('PRIMARY KEY', 'UNIQUE') as $keyword) {
					if(strpos($definition, $keyword) !== NULL) {
						$definition = str_replace($keyword, '', $definition);
						$keys .= ' ' . $keyword . ' (' . $row . '),';
					}
				}
			}
			$sql .= ' ' . $row . ' ' . $definition . ',';
		}
		if('mysql' == $type) {
			if(!strlen($keys)) {
				$sql = rtrim($sql, ',');
			}
			$sql .= ' ' . rtrim($keys, ',') . ' ) ENGINE=MyISAM DEFAULT CHARACTER SET utf8';
		} else {
			$sql = rtrim($sql, ',') . ' )';
		}
		$this->getDb()->query($sql);
	}

	/**
	 * checks if the current database table exists, optionally creates it
	 *
	 * @access public
	 * @param  bool $create
	 * @throws Exception
	 * @return bool
	 */
	public function tableExists($create = FALSE)
	{
		$type = $this->getDb()->getAttribute(PDO::ATTR_DRIVER_NAME);
		switch($type)
		{
			case 'ibm':
				$sql = 'SELECT tabname FROM SYSCAT.TABLES';
				break;
			case 'informix':
				$sql = 'SELECT tabname FROM systables';
				break;
			case 'mssql':
				$sql = "SELECT name FROM sysobjects "
				     . "WHERE type = 'U' ORDER BY name";
				break;
			case 'mysql':
				$sql = 'SHOW TABLES';
				break;
			case 'oci':
				$sql = 'SELECT table_name FROM all_tables';
				break;
			case 'pgsql':
				$sql = "SELECT c.relname AS table_name "
				     . "FROM pg_class c, pg_user u "
				     . "WHERE c.relowner = u.usesysid AND c.relkind = 'r' "
				     . "AND NOT EXISTS (SELECT 1 FROM pg_views WHERE viewname = c.relname) "
				     . "AND c.relname !~ '^(pg_|sql_)' "
				     . "UNION "
				     . "SELECT c.relname AS table_name "
				     . "FROM pg_class c "
				     . "WHERE c.relkind = 'r' "
				     . "AND NOT EXISTS (SELECT 1 FROM pg_views WHERE viewname = c.relname) "
				     . "AND NOT EXISTS (SELECT 1 FROM pg_user WHERE usesysid = c.relowner) "
				     . "AND c.relname !~ '^pg_'";
				break;
			case 'sqlite':
				$sql = "SELECT name FROM sqlite_master WHERE type='table' "
				     . "UNION ALL SELECT name FROM sqlite_temp_master "
				     . "WHERE type='table' ORDER BY name";
				break;
			default:
				throw new Exception('We are sorry, PDO type "' . $type . '" is currently not supported.');
		}
		$exists = array_key_exists(
			$this->getTable(),
			$this->getDb()->query($sql)->fetchAll(PDO::FETCH_COLUMN, 0)
		);

		if(!$create) {
			return $exists;
		} else {
			$this->_createTable($type);
			if(
				!array_key_exists(
					$this->getTable(),
					$this->getDb()->query($sql)->fetchAll(PDO::FETCH_COLUMN, 0)
				)
			) {
				throw new Exception('Database table "' . $this->getTable() . '" does not exist and can\'t be created.');
			} else {
				return TRUE;
			}
		}
	}

	/**
	 * gets the database connection
	 *
	 * @access public
	 * @return PDO
	 */
	public function getDb()
	{
		return $this->_db->getDb();
	}

	/**
	 * gets a view instance
	 *
	 * @access public
	 * @return string
	 */
	public function getTable()
	{
		return $this->_view;
	}
}
