<?php

class Users {
	public $connection = null;
	public $error = null;

	private $servername = "mysql.hostinger.lv";
	private $username = "u798688759_web";
	private $password = "123456";
	private $dbname = "u798688759_solar";
	private $table = "users";
	

	function getServername() { return $this->servername; }
	function getUsername() { return $this->username; }
	function getPassword() { return $this->password; }
	function getDBname() { return $this->dbname; }
	function getTable() { return $this->table; }
	
	 
	function __construct() {
       $this->connection = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
	   
		// Check connection
		if ($this->connection->connect_error) {
			$this->error = "Connection to database failed";
			$this->connection = null;
			return; 
		}
		
		$sql = "select 1 from $this->table LIMIT 1";
		$result = $this->connection->query($sql);
		if($result === FALSE) {
			$sql = "CREATE TABLE $this->table (
					 `id` int(11) NOT NULL AUTO_INCREMENT,
					 `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
					 `surname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
					 `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
					 `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
					 `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
					 `authlevel` smallint(1) NOT NULL DEFAULT '0',
					 PRIMARY KEY (`id`),
					 UNIQUE KEY `nickname` (`username`),
					 UNIQUE KEY `email` (`email`)
					) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";
			$result = $this->connection->query($sql);
			
			if ($result === FALSE) {
				$this->error = "Unable to create $this->table table";
				die($this->error);
			}
		}

	}
	
	function __destruct() {
       if ($this->connection) $this->connection->close();
	}
	
	
	function addUser($name, $surname, $username, $email, $password) {
		if ($this->connection == false) {
			$this->error = "Unable to add new user! No connection to database!";
			return false; 
		}
		
		// No need cuz of UNIQUE key in DB
		/*$sql = "SELECT username FROM users WHERE username = '$username' OR email ='$email'";
		$result = $this->conn->query($sql);

		echo "Check existense<br>";
		if ($result->num_rows > 0) return false; // User with such username or email already exist!
		*/
		
		$sql = "INSERT INTO $this->table (id, name, surname, username, email, password)
		VALUES ('', '$name', '$surname', '$username', '$email', '$password')";

		if ($this->connection->query($sql) === TRUE) {
			$_SESSION['username'] = $username;
			$_SESSION['id'] = $this->connection->insert_id;
			$_SESSION['authlevel'] = 0;
			echo "New record created successfully<br>";
			return true;
		} else {
			if ($this->connection->errno == 1062) {
				echo "DUPLICATE<br>"; // User with such username or email already exist!
				$this->error = "Unable to add new user! User with such username or email already exist!";
			}
			return false;
		}
	}
	
	function editUser($userid, $name, $surname, $email, $password) {
		if ($this->connection == false) {
			$this->error = "No connection to database!";
			return false; 
		}
		
		$sql = "UPDATE $this->table SET 
			name = '$name', surname = '$surname', email = '$email', password = '$password'
			WHERE id='$userid'";
		
		if ($this->connection->query($sql) === TRUE) {
			return true;
		} else {
			if ($this->connection->errno == 1062) {
				echo "DUPLICATE<br>"; // User with such username or email already exist!
				$this->error = "Unable to add new user! User with such username or email already exist!";
			}
			return false;
		}
	}
	
	function deleteUser($userid) {
		if ($this->connection == false) {
			$this->error = "No connection to database!";
			return false; 
		}
		
		$sql = "DELETE FROM $this->table WHERE id = '$userid'";
		$this->connection->query($sql);
		
		if ($this->connection->affected_rows > 0)
			return true;
		else 
			$this->error = "User doesnt exist";
		
		return false;
		
	}
	
	function loginUser($useremail, $password) {
		if ($this->connection == false) {
			$this->error = "No connection to database! Sorry :(";
			return false; 
		}
		
		$sql = "SELECT id, name, surname, username, authlevel FROM $this->table WHERE (username = '$useremail' OR email = '$useremail') AND password = '$password'";
		$result = $this->connection->query($sql);

		if ($result->num_rows == 1) {
			$row = $result->fetch_assoc();
			$_SESSION['username'] = $row["username"];
			$_SESSION['id'] = $row['id'];
			$_SESSION['authlevel'] = $row["authlevel"];
			return true;
		} else
			$this->error = "Wrong username/email or password";
			
		return false;
	}
	
	function checkExistence($userid) {
		if ($this->connection == false) {
			$this->error = "No connection to database! Sorry :(";
			return false; 
		}
		
		$sql = "SELECT id FROM $this->table WHERE id = '$userid'";
		$result = $this->connection->query($sql);

		if ($result->num_rows == 1)
			return true;
		
		return false;
	}
	
	function getUser($id) {
		if ($this->connection == false) {
			$this->error = "No connection to database! Sorry :(";
			return false; 
		}
		
		$sql = "SELECT * from $this->table WHERE id = '$id'";
		$result = $this->connection->query($sql);
		
		if ($result->num_rows == 1)
			return $result->fetch_assoc();
	}
	
	function getUsers() {
		if ($this->connection == false) {
			$this->error = "No connection to database! Sorry :(";
			return false; 
		}
		
		$sql = "SELECT * from $this->table";
		$result = $this->connection->query($sql);
		
		return $result;
	}
	
}