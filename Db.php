<?php

class Db {
	public $connection = null;
	public $is_connected = false;
	public function __construct($server, $database, $username, $password) {
		try {
	    $connection = new PDO("mysql:host=$server;dbname=$database", $username, $password);
	    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    $connection->exec("set foreign_key_checks=0");
	    $this->connection = $connection;
	    $this->is_connected = true;
	  } catch(PDOException $e) {
	    echo "Connection failed: " . $e->getMessage();
	  }

	}
	public function get_all_tables () {

    $sql = 'SHOW TABLES';
    if($this->is_connected)
    {
        $query = $this->connection->query($sql);
        return $query->fetchAll(PDO::FETCH_COLUMN);
    }
    return [];

	}

	public function delete_single_table($table_name) {
		$sql = "DROP TABLE IF EXISTS $table_name";
    if($this->is_connected)
    {
        $query = $this->connection->query($sql);
        return true;
    }
    return FALSE;
	}
	public function delete_all_tables($arr) {
		foreach($arr as $table_name) {
			$this->delete_single_table($table_name);
		}
		echo "All database delete successfully";
	}
	public function delete_all_tables_worker() {
		$tables = $this->get_all_tables();
		if ($tables) {
			$this->delete_all_tables($tables);
		} else {
			echo 'Dbs is empty. No Table found';
		}
	}
}
