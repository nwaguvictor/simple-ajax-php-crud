<?php 

	class Database {
		private $server = 'localhost';
		private $user	= 'root';
		private $pass	= '';
		private $dbname	= 'ajax_crud_oop';
		protected $conn;

		// Connecting to the database
		public function __construct() {
			$this->conn = new mysqli($this->server, $this->user, $this->pass, $this->dbname);
			if ($this->conn->errno) {
				die("Connecting to database failed...".$this->conn->error);
			}
		}
	}

?>