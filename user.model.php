<?php 
	require_once("db.php");
	
	class User extends Database {

		function check_input($data) {
			$data = trim($data);
			$data = htmlentities($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);

			return $data;

		}

		// Insert query
		public function insert($fname, $lname, $email, $phone) {
			$fname = $this->check_input($fname);
			$lname = $this->check_input($lname);
			$email = $this->check_input($email);
			$phone = $this->check_input($phone);

			$new_fname = $this->conn->real_escape_string($fname);
			$new_lname = $this->conn->real_escape_string($lname);
			$new_email = $this->conn->real_escape_string($email);
			$new_phone = $this->conn->real_escape_string($phone);

			$check_email = $this->conn->query("SELECT * FROM users WHERE email = '$email'");
			if ($check_email->num_rows == 0) {
				$sql = "INSERT INTO users(firstname, lastname, email, phone) VALUES('$new_fname', '$new_lname', '$new_email', '$new_phone')";
				$query = $this->conn->query($sql) or die("error".$this->conn->error);
			}

			return $query;
		}

		// getting all users
		public function read() {
			$query = $this->conn->query("SELECT * FROM users");
			if ($query->num_rows > 0){
				while ($row = $query->fetch_assoc()){
					$data[] = $row;
				}
				return $data;
				}			
		}

		// Get User by his id
		public function getUserById($id) {
			$sql = "SELECT * FROM users WHERE id = $id";
			$query = $this->conn->query($sql) or die("Error Occurred... ".$this->conn->error);
			if ($query->num_rows == 1) {
				$result = $query->fetch_assoc();
			}
			return $result;

		}

		// Updating a user
		public function update($id, $fname, $lname, $email, $phone){
			$id 	= $id;
			$fname 	= $this->check_input($fname);
			$lname 	= $this->check_input($lname);
			$email 	= $this->check_input($email);
			$phone 	= $this->check_input($phone);

			$fname = $this->conn->real_escape_string($fname);
			$lname = $this->conn->real_escape_string($lname);
			$email = $this->conn->real_escape_string($email);
			$phone = $this->conn->real_escape_string($phone);

			$sql = "UPDATE users SET firstname = '$fname', lastname='$lname', email='$email', phone='$phone' WHERE id=$id";
			$query = $this->conn->query($sql) or die("Error occurred... ".$this->conn->error);
			return true;
		}

		// Deleting user
		public function deleteUser($id){
			$query = $this->conn->query("DELETE FROM users WHERE id = $id");
			return true;
		}

		// Counting rows
		public function totalRowCount() {
			$query = $this->conn->query("SELECT * FROM users");
			$numRows = $query->num_rows;
			return $numRows;
		}
	}

?>