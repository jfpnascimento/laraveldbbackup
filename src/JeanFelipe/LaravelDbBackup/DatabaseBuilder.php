<?php 

namespace JeanFelipe\LaravelDbBackup;

use JeanFelipe\LaravelDbBackup\Console;
use JeanFelipe\LaravelDbBackup\Databases\MySQLDatabase;
use JeanFelipe\LaravelDbBackup\Databases\SqliteDatabase;
use JeanFelipe\LaravelDbBackup\Databases\PostgresDatabase;

class DatabaseBuilder
{
	/**
	 * @var array
	 */
	protected $database;

	/**
	 * @var Witty\LaravelDbBackup\Console
	 */
	protected $console;

	public function __construct()
	{
		$this->console = new Console();
	}

	/**
	 * @param array $realConfig
	 * @return Witty\LaravelDbBackup\Databases\DatabaseContract
	 */
	public function getDatabase(array $realConfig)
	{
		switch ($realConfig['driver'])
		{
			case 'mysql': $this->buildMySQL($realConfig); break;
			case 'sqlite': $this->buildSqlite($realConfig); break;
			case 'pgsql': $this->buildPostgres($realConfig); break;
			default: throw new \Exception('Database driver not supported yet'); break;
		}

		return $this->database;
	}

	/**
	 * @param array $config
	 * @return void
	 */
	protected function buildMySQL(array $config)
	{
		$port = isset($config['port']) ? $config['port'] : 3306;

		$this->database = new MySQLDatabase(
			$this->console,
			$config['database'],
			$config['username'],
			$config['password'],
			$config['host'],
			$port
		);
	}

	/**
	 * @param array $config
	 * @return void
	 */
	protected function buildSqlite(array $config)
	{
		$this->database = new SqliteDatabase(
			$this->console,
			$config['database']
		);
	}

	/**
	 * @param array $config
	 * @return void
	 */
	protected function buildPostgres(array $config)
	{
		$this->database = new PostgresDatabase(
			$this->console,
			$config['database'],
			$config['username'],
			$config['password'],
			$config['host']
		);
	}
}