<?php
namespace core\libs;

class Database {
	private $host = DB_HOST;
	private $user = DB_USER;
	private $pass = DB_PASS;
	private $dbname = DB_NAME;
	// Database Handler and errors
	private $dbh;
	private $error;
	// Hold the database query
	private $stmt;

	public function __construct () {
			// Set DSN
			$dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;

			// Set options
			$options = array(
					\PDO::ATTR_PERSISTENT => true,
					\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
					\PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
					\PDO::ATTR_EMULATE_PREPARES => false

			);

			// Attempt DB Connection
			try {
					$this->dbh = new \PDO($dsn, $this->user, $this->pass, $options);
			} catch (PDOException $e) {
					$this->error = $e->getMessage();
			}
	}

	public function query($query) {
		$this->stmt = $this->dbh->prepare($query);
	}

	public function bind($param, $value, $type = null) {
			if (is_null($type)) {
					switch (true) {
							case is_int($value):
									$type = \PDO::PARAM_INT;
									break;
							case is_bool($value):
									$type = \PDO::PARAM_BOOL;
									break;
							case is_null($value):
									$type = \PDO::PARAM_NULL;
									break;
							default:
									$type = \PDO::PARAM_STR;
					}
			}
			$this->stmt->bindValue($param, $value, $type);
	}

	public function execute () {
			return $this->stmt->execute();

	}

	public function resultset (){
			$this->execute();
			return $this->stmt->fetchAll(\PDO::FETCH_ASSOC);
	}

	public function single (){
			$this->execute();
			return $this->stmt->fetch(\PDO::FETCH_ASSOC);
	}

	public function rowCount (){
			return $this->stmt->rowCount();
	}

	public function lastInsertId () {
			return $this->dbh->lastInsertId();
	}

	// Transaction Methods

	public function beginTransaction () {
			return $this->dbh->beginTransaction();
	}

	public function endTransaction () {
			return $this->dbh->commit();
	}

	public function cancelTransaction () {
			return $this->dbh->rollBack();
	}

	public function debugDumpParams () {
			return $this->stmt->debugDumpParams();
	}

	/**
	 * Select single row from Database
	 * @param  string $sql                 An SQL string
	 * @param  array  $array               Paramters to bind
	 * @return array Returns single result
	 */
	public function select1 ($sql, $array = array()) {

		$this->query("$sql");

		foreach ($array as $key => $value) {
			$this->bind("$key", $value);
		}
		$this->execute();
		return $this->single();
	}

	/**
	 * Select data from database
	 * @param  string $sql                 An SQL string
	 * @param  array  $array               Paramters to bind
	 * @return array  Returns Multidimensional Array
	 */
	public function select ($sql, $array = array()) {

		$this->query("$sql");

		foreach ($array as $key => $value) {
			$this->bind("$key", $value);
		}
		$this->execute();
		return $this->resultSet();
	}

	/**
	 * Inset an array of data into the selected table
	 * @param string $table The name of the table to insert into
	 * @param array  $data  An associative array
	 */
	public function insert ($table, $data) {

		ksort($data); //sort by alphabetical value

		$fieldNames = implode('`, `', array_keys($data));
		$fieldValues = ':' . implode(', :', array_keys($data));;

		$this->query("
			INSERT INTO
				$table
				(`$fieldNames`)
			VALUES
				($fieldValues)
		");

		foreach ($data as $key => $value) {
			$this->bind(":$key", $value);
		}
		$this->execute();
		
	}

	/**
	 * Update table
	 * @param string $table The name of the table to update
	 * @param array  $data  An associative array
	 * @param string $where Condition to apply the update
	 */
	public function update($table,$data,$where) {

		ksort($data); //sort by alphabetical value

		$fieldDetails = null;
		foreach ($data as $key =>$value) {
			$fieldDetails .= "`$key` = :$key, ";
		}
		$fieldDetails = rtrim($fieldDetails, ', ');

		$this->query("UPDATE $table SET $fieldDetails WHERE $where");

		// Bind each of the array elements
		foreach ($data as $key => $value) {
			$this->bind(":$key", $value);
		}
		$this->execute();
	}
	
	/**
	 * Delete from database
	 * @param string  $table       The Table to delete from
	 * @param string  $where       Condition to delete
	 * @param integer [$limit      = 1] Limit the delete default is 1
	 */
	public function delete($table,$where,$limit = 1) {
		$this->query("DELETE FROM  $table WHERE $where LIMIT $limit");
		$this->execute();
	}
}
?>
