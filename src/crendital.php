<?php
namespace Media;

/**
 * 
 */
class crendital 
{

	protected string $dsn;
	protected \PDO $pdo;

	function __construct()
	{	
		$this->dsn = 'pgsql:host=localhost;port=5432;dbname=media_db;user=ulna;password=radius2';
		$this->pdo = new \PDO($this->dsn);
	}

	public function getPDO()
	{
		return $this->pdo;
	}

	public function getDsn(){
		return $this->dsn;
	}


}
