<?php
session_start();

class Articles {
	public $connection = null;
	public $error = null;

	private $servername = "mysql.hostinger.lv";
	private $username = "u798688759_web";
	private $password = "123456";
	private $dbname = "u798688759_solar";
	
	private $table_categories = "categories";
	private $table_posts = "posts";
	private $table_comments = "comments";
	

	function getServername() { return $this->servername; }
	function getUsername() { return $this->username; }
	function getPassword() { return $this->password; }
	function getDBname() { return $this->dbname; }
	function getTableCategories() { return $this->$table_categories; }
	function getTablePosts() { return $this->$table_posts; }
	function getTableComments() { return $this->$table_categories; }
	
	
	function __construct() {
       $this->connection = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
	   
		// Check connection
		if ($this->connection->connect_error) {
			$this->error = "Connection to database failed";
			$this->connection = null;
			return; 
		}
		
		$sql = "select 1 from $this->table_categories LIMIT 1";
		$result = $this->connection->query($sql);
		if($result === FALSE) {
			$sql = "CREATE TABLE $this->table_categories (
					 `id` int(11) NOT NULL AUTO_INCREMENT,
					 `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
					 `timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
					 PRIMARY KEY (`id`),
					 UNIQUE KEY `name` (`name`)
					) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";
			$result = $this->connection->query($sql);
			
			if ($result === FALSE) {
				$this->error = "Unable to create $this->table_categories table";
				die($this->error);
				return;
			}
		}
		
		$sql = "select 1 from $this->table_posts LIMIT 1";
		$result = $this->connection->query($sql);
		if($result === FALSE) {
			$sql = "CREATE TABLE $this->table_posts (
					 `id` int(11) NOT NULL AUTO_INCREMENT,
					 `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
					 `categoryid` int(11) NOT NULL,
					 `ownerid` int(11) NOT NULL,
					 `text` varchar(32768) COLLATE utf8_unicode_ci NOT NULL,
					 `timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
					 PRIMARY KEY (`id`)
					) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";
			$result = $this->connection->query($sql);
			
			if ($result === FALSE) {
				$this->error = "Unable to create $this->table_posts table";
				$this->error = $result->errno;
				die($this->error);
				return;
			}
		}
		
		$sql = "select 1 from $this->table_comments LIMIT 1";
		$result = $this->connection->query($sql);
		if($result === FALSE) {
			$sql = "CREATE TABLE $this->table_comments (
					 `id` int(11) NOT NULL AUTO_INCREMENT,
					 `postid` int(11) NOT NULL,
					 `ownerid` int(11) NOT NULL,
					 `text` varchar(2048) COLLATE utf8_unicode_ci NOT NULL,
					 `timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
					 PRIMARY KEY (`id`)
					) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";
			$result = $this->connection->query($sql);
			
			if ($result === FALSE) {
				$this->error = "Unable to create $this->table_comments table";
				die($this->error);
				return;
			}
		}

	}
	
	function __destruct() {
       if ($this->connection) $this->connection->close();
	}
	
	function addCategory($name) {
		if ($this->connection == false) {
			$this->error = "No connection to database!";
			return false; 
		}
		
		$sql = "INSERT INTO $this->table_categories (id, name)
		VALUES ('', '$name')";

		if ($this->connection->query($sql) === TRUE) {
			echo "New record created successfully<br>";
			return true;
		} else {
			if ($this->connection->errno == 1062) {
				echo "DUPLICATE<br>"; // Category with such name already exist!
				$this->error = "Category with such name already exist";
			}
			return false;
		}
	}
	
	function getCategories() {
		if ($this->connection == false) {
			$this->error = "No connection to database!";
			return false; 
		}
		
		$sql = "SELECT * from $this->table_categories ORDER BY timestamp";
		return $this->connection->query($sql);
	}
	
	function deleteCategory($categoryid) {
		if ($this->connection == false) {
			$this->error = "No connection to database!";
			return false; 
		}
		
		$sql = "SELECT * from $this->table_posts WHERE categoryid = '$categoryid'";
		$result = $this->connection->query($sql);
		if ($result->num_rows > 0)
			while($post = $result->fetch_assoc())
				$this->deletePost($post['id']);
		
		$sql = "DELETE FROM $this->table_categories WHERE id = '$categoryid'";
		$result = $this->connection->query($sql);
		if ($this->connection->affected_rows > 0)
			return true;
		
		return false;
	}
	
	
	
	
	
	function addPost($name, $categoryid, $ownerid, $text) {
		if ($this->connection == false) {
			$this->error = "No connection to database!";
			return false; 
		}
		
		$sql = "SELECT * FROM $this->table_categories WHERE id = '$categoryid'";
		$result = $this->connection->query($sql);
		if ($result->num_rows < 1) return false;

		
		$sql = "INSERT INTO $this->table_posts (id, name, categoryid, ownerid, text)
		VALUES ('', '$name', '$categoryid', '$ownerid', '$text')";

		if ($this->connection->query($sql) === TRUE)
			return true;
	}
	
	function editPost($postid, $name, $categoryid, $ownerid, $text) {
		if ($this->connection == false) {
			$this->error = "No connection to database!";
			return false; 
		}
		
		$sql = "UPDATE $this->table_posts SET 
			name = '$name', categoryid = '$categoryid', 
			ownerid = '$ownerid', text = '$text' 
			WHERE id='$postid'";
		
		if ($this->connection->query($sql) === TRUE) {
			return true;
		}
	}
	
	function deletePost($postid, $ownerid) {
		if ($this->connection == false) {
			$this->error = "No connection to database!";
			return false; 
		}
		

		$sql = "SELECT * from $this->table_comments WHERE postid = '$postid' or ownerid = '$ownerid'";
		$result = $this->connection->query($sql);
		if ($result->num_rows > 0)
			while($comment = $result->fetch_assoc())
				$this->deleteComment($comment['id']);
			
		
		$sql = "DELETE FROM $this->table_posts WHERE id = '$postid'";
		$result = $this->connection->query($sql);
		if ($this->connection->affected_rows > 0)
			return true;
		
		return false;
	}
	
	function getPost($postid) {
		if ($this->connection == false) {
			$this->error = "No connection to database!";
			return false; 
		}
		
		if ($postid != 0) {
			$sql = "SELECT * from $this->table_posts WHERE id = '$postid'";
			$result = $this->connection->query($sql);
			if ($result->num_rows == 1)
				return $result->fetch_assoc();
		} else {
			$sql = "SELECT * from $this->table_posts ORDER BY rand() LIMIT 1";
			$result = $this->connection->query($sql);
			if ($result->num_rows == 1) {
				$result = $result->fetch_assoc();
				$_GET['postid'] = $result['id'];
				return $result;
			}
		}
	}
	
	function getPosts($categoryid) {
		if ($this->connection == false) {
			$this->error = "No connection to database!";
			return false; 
		}
		
		$sql = "SELECT * from $this->table_posts WHERE categoryid = '$categoryid' ORDER BY timestamp";
		return $this->connection->query($sql);
	}
	
	
	
	
	
	function addComment($postid, $ownerid, $text) {
		if ($this->connection == false) {
			$this->error = "No connection to database!";
			return false; 
		}
		
		if ($postid == 0) return false;
		
		$sql = "INSERT INTO $this->table_comments (id, postid, ownerid, text)
		VALUES ('', '$postid', '$ownerid', '$text')";

		if ($this->connection->query($sql) === TRUE) {
			echo "New record created successfully<br>";
			return true;
		}
	}
	
	function deleteComment($commentid) {
		if ($this->connection == false) {
			$this->error = "No connection to database!";
			return false; 
		}
		
		$sql = "DELETE FROM $this->table_comments WHERE id = '$commentid'";
		$result = $this->connection->query($sql);
		if ($this->connection->affected_rows > 0)
			return true;
		
		return false;
	}

	function getComments($postid) {
		if ($this->connection == false) {
			$this->error = "No connection to database!";
			return false; 
		}
		
		$sql = "SELECT * from $this->table_comments WHERE postid = '$postid' ORDER BY timestamp";
		return $this->connection->query($sql);
	}
}