<?php

class Database
{

	private $host = 'localhost';
	private $user = 'root';
	private $pass = 'admin123';
	private $db_name = 'project';

	private $dbh;
	private $stmt;
	private $error;

	public function __construct()
	{

		$dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->db_name . ';charset=utf8;';
		$options = array(
			PDO::ATTR_PERSISTENT => true,
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
		);

		try {
			$this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
		} catch (PDOException $e) {
			$this->error = $e->getMessage();
		}
	}

	public function query($query)
	{
		$this->stmt = $this->dbh->prepare($query);
	}

	public function bind($param, $value, $type = null)
	{

		if (is_null($type)) {
			switch (true) {
				case is_int($value):
					$type = PDO::PARAM_INT;
					break;
				case is_null($value):
					$type = PDO::PARAM_NULL;
					break;
				case is_bool($value):
					$type = PDO::PARAM_BOOL;
					break;
				default:
					$type = PDO::PARAM_STR;
			}
		}
		$this->stmt->bindValue($param, $value, $type);
	}

	public function execute()
	{
		return $this->stmt->execute();
	}

	public function resultSet()
	{
		$this->stmt->execute();
		return $this->stmt->fetchAll(PDO::FETCH_OBJ);
	}

	public function single()
	{
		$this->stmt->execute();
		return $this->stmt->fetch(PDO::FETCH_OBJ);
	}

	public function rowCount()
	{
		return $this->stmt->rowCount();
	}

	public function lastInsertId()
	{
		return $this->dbh->lastInsertId();
	}
}
