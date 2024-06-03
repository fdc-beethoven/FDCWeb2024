<?php
class DB { 
	private $host;
	private $username;
	private $password;
	private $dbname;
	public $conn;


	function __construct () {
		$this->host = 'db';
		$this->username = 'root';
		$this->password = 'cde3bgt5_root';
		$this->dbname = 'task_management';

		// - connect to database
		$this->connectToDB();
	}

	private function connectToDB () {
		// - connect to the database
		$this->conn = new mysqli(
			$this->host,
			$this->username,
			$this->password,
			$this->dbname
		);

		if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
            exit;
        }
	}

	public function prepare($query) {
		return $this->conn->prepare($query); // Call mysqli_prepare on the connection
	}
}