<?php
session_start();
include("php/class_Users.php");
include("php/class_Articles.php");

class Blocks {
	
	function insertNavBar() {
		

		if ($_SESSION['username'] == '') {
			if (isset($_POST['login'])) {
				$users = new Users();

				if (!$users->loginUser($_POST['useremail'], $_POST['password']))
					$loginError = $users->error;
			}
			if (isset($_POST['register'])) {
				$users = new Users();

				if (!$users->addUser($_POST['name'], $_POST['surname'], $_POST['username'], $_POST['email'], $_POST['password']))
					$registerError = $users->error;
			}
		} else {
			$users = new Users();
			if(!$users->checkExistence($_SESSION['id']))
				header('Location: logout.php');;
		}
		
		
		if (isset($_POST['submitComment'])) {
			$articles = new Articles();
		
			if (!$articles->addComment($_POST['commentpostid'], $_SESSION['id'], $_POST['commentText']))
				$commentError = "error..";	
		}
		
		if (isset($_POST['submitArticle'])) {
			$articles = new Articles();
		
			if ($articles->addPost($_POST['arttitle'], $_POST['categoryid'], $_SESSION['id'], $_POST['arttext']))
				$_POST['editpostid'] = 0;
			else
				die( $_POST['arttitle']);
		}
		
		if (isset($_POST['submitEditArticle'])) {
			$articles = new Articles();
			$post = $articles->getPost($_POST['editpostid']);
			
			if ($_SESSION['authlevel'] > 0 || $post['ownerid'] == $_SESSION['id'])
				$articles->editPost($_POST['editpostid'], $_POST['arttitle'], $_POST['categoryid'], $_SESSION['id'], $_POST['arttext']);
		}
		
		if (isset($_POST['submitEditProfile'])) {
			$users = new users();
			
			if ($_SESSION['authlevel'] > 0 || $_GET['profileid'] == $_SESSION['id'])
				$users->editUser($_GET['profileid'], $_POST['name'], $_POST['surname'], $_POST['email'], $_POST['password']);
		}
		
		if (isset($_POST['submitDeleteProfile'])) {
			$users = new users();
			
			if ($_SESSION['authlevel'] > 0 || $_GET['profileid'] == $_SESSION['id'])
				if($users->deleteUser($_GET['profileid'])) {
					$articles = new Articles();
					$articles->deletePost(0, $_GET['profileid']);
					header("refresh: 0;");
				}
		}
		
		if (isset($_GET['deluserid'])) {
			$users = new users();
			if ($_SESSION['authlevel'] > 0 || $_GET['deluserid'] == $_SESSION['id'])
				if($users->deleteUser($_GET['deluserid'])) {
					$articles = new Articles();
					$articles->deletePost(0, $_GET['deluserid']);
					header("refresh: 0;");
				}
		}
		
		

		
		if (isset($_GET['delpostid'])) {
			$articles = new Articles();
			$post = $articles->getPost($_GET['delpostid']);
			if ($_SESSION['authlevel'] > 0 || $post['ownerid'] == $_SESSION['id'])
				$articles->deletePost($_GET['delpostid']);	
		}
		
		
		
		if (isset($_POST['addcategory'])) {
			if ($_SESSION['authlevel'] > 0) {
				$articles = new Articles();
				$articles->addCategory($_POST['catname']);	
			}
		}
		
		if (isset($_POST['delcategory'])) {
			$articles = new Articles();
			$post = $articles->getPost($_POST['catid']);
			if ($_SESSION['authlevel'] > 0)
				$articles->deleteCategory($_POST['catid']);	
		}
		
		if (isset($_GET['delcategoryid'])) {
			$articles = new Articles();
			if ($_SESSION['authlevel'] > 0)
				$articles->deleteCategory($_GET['delcategoryid']);	
		}
		
		
		$_SESSION['currentURL'] = htmlspecialchars($_SERVER["PHP_SELF"]);
		
		if ($loginError)
			echo "<script type='text/javascript'>
				$(document).ready(function() {
					$('#login-modal').modal('show');
				});
				</script>";
		if ($registerError)
			echo "<script type='text/javascript'>
				$(document).ready(function() {
					$('#register-modal').modal('show');
				});
				</script>";
		if ($_GET['editpostid']) {
			echo "<script type='text/javascript'>
				$(document).ready(function() {
					$('#editarticle-modal').modal('show');
				});
				</script>";
			$articles = new Articles();
			$post = $articles->getPost($_GET['editpostid']);
			$_GET['postid'] = $_GET['editpostid'];			
		}
			
		echo '<div class="navbar-wrapper">
                <div class="container-fluid">
                    <nav class="navbar navbar-fixed-top">
                        <div class="container">
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                                <a class="navbar-brand" href="index.php">Animal</a>
                            </div>
                            <div id="navbar" class="navbar-collapse collapse">
                                <ul class="nav navbar-nav">
                                    <li><a href="index.php" class="">Home</a></li>
                                    <li><a href="Animal.php" class="dropdown-toggle " data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Animal<span class="caret"></span></a>
									<ul class="dropdown-menu">
											<li><a href="Animal.php">Articles</a></li>
											';
											if ($_SESSION['username'])
												echo '
                                            <li><a href="#" data-toggle="modal" data-target="#newatricle-modal">Add article</a></li>';
                                        echo '</ul>
									</li>
                                    <li><a href="gallery.php">Gallery</a></li>
                                    <li ><a href="contacts.php">Contacts</a></li>
                                </ul>';
								if ($_SESSION['username']) {
									echo '<ul class="nav navbar-nav navbar-right">
									<li ><a href="" class="dropdown-toggle " data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">';
									
									if ($_SESSION['authlevel'] > 0) 
										echo '<span class="glyphicon glyphicon-king"></span>'; 
									else 
										echo '<span class=" glyphicon glyphicon-user"></span>'; 
									echo ' | ', $_SESSION['username'] , '<span class="caret"></span></a>
									
									
										<ul class="dropdown-menu">';
									if ($_SESSION['authlevel'] > 0) {
										echo '<li class=""><a href="#" data-toggle="modal" data-target="#profilelist-modal">User list</a></li>';
										echo '<li class=""><a href="#" data-toggle="modal" data-target="#category-modal">Categories</a></li>';
									}
									echo '
											<li><a href="profile.php?profileid=', $_SESSION['id'] ,'">Profile</a></li>
											<li><a href="logout.php">Logout</a></li>
										</ul>
									</li>
									</ul>';
								} else
									echo '<ul class="nav navbar-nav navbar-right">
                                    <li class=""><a href="#" data-toggle="modal" data-target="#login-modal">Sign in</a></li>
                                    <li class=""><a href="#" data-toggle="modal" data-target="#register-modal">Register</a></li>';
								
                                echo '</ul>
                            </div>
                        </div>
                    </nav>
                    
                    <div class="modal fade" id="contact-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none">
                        <div class="modal-dialog">
                            <div class="contactmodal-container">
                                <center><h1>Contact us</h1><br></center>
                                <form>
                                    <h4>Name</h4>
                                    <input type="text" name="name" placeholder="name">
                                    <h4>Your E-mail</h4>
                                    <input type="email" name="email" placeholder="e-mail">
                                    <h4>Your Message</h4>
                                    <input type="text" name="message" placeholder="Please enter your message here..." rows="5">
                                    <input type="submit" name="message" class="contact contactmodal-submit" value="Send">

                                </form>
                            </div>
                        </div>
                    </div></div>
                    
                    <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none">
                        <div class="modal-dialog">
                            <div class="loginmodal-container">
                                <h1>Sign in to Your Account</h1><br>
								<div class="text-danger">', $loginError ,'</div><br>
                                <form action="', htmlspecialchars($_SERVER["PHP_SELF"]) ,'" method="post">
                                    <h4>Username or e-mail</h4>
                                    <input type="text" name="useremail" placeholder="username or e-mail">
                                    <h4>Password</h4>
                                    <input type="password" name="password" placeholder="password">
                                    <input type="submit" name="login" class="login loginmodal-submit" value="Sign in">
                                </form>
                                <div class="login-help">
                                    <a href="#" data-toggle="modal" data-target="#register-modal">Register new account</a>
                                </div>
                            </div>
                        </div>
                    </div></div>
					
                    <div class="modal fade" id="register-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none">
                        <div class="modal-dialog">
                            <div class="registermodal-container">
                                <h1>Create a new Account</h1><br>
								<div class="text-danger">', $registerError ,'</div><br>
                                <form action="', htmlspecialchars($_SERVER["PHP_SELF"]) ,'" method="post">
                                    <h4>*Name</h4>
                                    <input type="text" name="name" placeholder="name">
                                    <h4>*Surname</h4>
                                    <input type="text" name="surname" placeholder="surname">
                                    <h4>*Username</h4>
                                    <input type="text" name="username" placeholder="username">
                                    <h4>*E-mail</h4>
                                    <input type="email" name="email" placeholder="e-mail">
                                    <h4>*Password</h4>
                                    <input type="password" name="password" placeholder="password">
                                    <input type="submit" name="register" class="register registermodal-submit" value="Register">
                                </form>
                            </div>
                        </div>
                    </div></div>
					<div class="modal fade" id="category-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none">
                    <div class="modal-dialog">
                        <div class="categorymodal-container">
                            <center><h1>Categories</h1><br></center>
                            <form action="', htmlspecialchars($_SERVER["PHP_SELF"]) ,'" method="post">
                                <h4>New category</h4>
                                <input type="text" name="catname" placeholder="name">
                                <h4>Category list</h4>
                                <div class="form-group">
                                    <select name="catid" class="form-control">
                                        ', $this->insertCategories() ,'
                                    </select>
                                </div> <!-- form group [rows] -->
                                <input type="submit" name="addcategory" class="category categorymodal-submit" value="Add category">
                                <input type="submit" name="delcategory" class="category categorymodal-submit" value="Remove category">
                            </form>
                        </div>
                    </div></div>
					
					<div class="modal fade" id="newatricle-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none">
                    <div class="modal-dialog">
                        <div class="loadmodal-container">
                            <center><h1>New Article</h1><br></center>
                            <form action="', htmlspecialchars($_SERVER["PHP_SELF"]) ,'" method="post">
                                <h4>Name</h4>
                                <input type="text" name="arttitle" placeholder="name">
								<select name="categoryid" class="form-control">
                                        ', $this->insertCategories() ,'
                                    </select>
                                <h4>Text</h4>
                                <textarea name="arttext" class="form-control" rows="5" required></textarea>
                                <input type="submit" name="submitArticle" class="contact loadmodal-submit" value="OK">
                            </form>
                        </div>
                    </div></div>
					
					<div class="modal fade" id="editarticle-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none">
                    <div class="modal-dialog">
                        <div class="loadmodal-container">
                            <center><h1>Article</h1><br></center>
                            <form action="', htmlspecialchars($_SERVER["PHP_SELF"]) ,'?postid=', $post['id'] ,'" method="post">
                                <h4>Name</h4>
								<input type="hidden" name="editpostid" value="', $post['id'] ,'">
                                <input type="text" name="arttitle" placeholder="name" value="', $post['name'] ,'">
								<select name="categoryid" class="form-control" selected="', $post['categoryid'] ,'">
                                        ', $this->insertCategories($post['categoryid']) ,'
                                    </select>
                                <h4>Text</h4>
                                <textarea name="arttext" class="form-control" rows="5" required>', $post['text'] ,'</textarea>
                                <input type="submit" name="submitEditArticle" class="contact loadmodal-submit" value="OK">
                            </form>
                        </div>
                    </div></div>
					
					<div class="modal fade" id="editprofile-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none">
                    <div class="modal-dialog">
                        <div class="registermodal-container">
							<h1>Edit profile</h1><br>
							<div class="text-danger">', $profileEditError ,'</div><br>
							<form action="', htmlspecialchars($_SERVER["PHP_SELF"]) ,'?profileid=', $_GET['profileid'] ,'" method="post">';
							$users = new Users();
							$user = $users->getUser($_GET['profileid']);
							echo'
								<h4>*Name</h4>
								<input type="text" name="name" placeholder="name" value="', $user['name']  ,'">
								<h4>*Surname</h4>
								<input type="text" name="surname" placeholder="surname" value="', $user['surname'] ,'">
								<h4>*E-mail</h4>
								<input type="email" name="email" placeholder="e-mail" value="', $user['email'] ,'">
								<h4>*Password</h4>
								<input type="password" name="password" placeholder="password" value="', $user['password'] ,'">
								<input type="submit" name="submitEditProfile" class="register registermodal-submit" value="Edit">
								<input type="submit" name="submitDeleteProfile" class="register registermodal-submit" value="Delete">
							</form>
                        </div>
                    </div></div>
					
					<div class="modal fade" id="profilelist-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none">
                    <div class="modal-dialog">
                        <div class="profilelistmodal-container">
							<h1>User list</h1><br>
							<div class="text-danger">', $profileListError ,'</div><br>'
							,$this->insertProfileList(),'
                        </div>
                    </div></div>
					
                </div>
            </div><br><br>';
	}
	
	function insertProfileList() {
		$users = new Users();
		$result = $users->getUsers();
		if ($result->num_rows > 0) {
			while ($user = $result->fetch_assoc()) {
				
				echo '<form action="', htmlspecialchars($_SERVER["PHP_SELF"]) ,'?profileid=', $_GET['profileid'] ,'" method="post">';
				echo $user['id'], '. ', $user['username'] ,' ', $user['name'] ,' ', $user['surname'] ,' ', $user['email'] ,' ', $user['authlevel'], ' ';
				echo '<a href="profile.php?profileid=', $user['id'], '"><span class="glyphicon glyphicon-edit text-danger"></span> </a>';
				echo '<a href="', htmlspecialchars($_SERVER["PHP_SELF"]) ,'?deluserid=', $user['id'], '"><span class="glyphicon glyphicon-remove text-danger"></span></a> </form>';
			}
		}
	}
	
	function insertProfile($id) {
		$users = new Users();
		$user = $users->getUser($id);
		if ($user) {
			echo '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 name">
						<center><h1>Profile</h1></center>
					</div>
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text">
						<div class="row">
							<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 inp">
								<center>
								<img src="gallery/home/home1.jpg" class="img-responsive"></center>
							</div>
							<div class="col-lg-9 col-md-8 col-sm-6 col-xs-12 inp">
								<center>
									<br>';
									if ($user['authlevel'] > 0) 
										echo '<span class="glyphicon glyphicon-king"></span>'; 
									else 
										echo '<span class=" glyphicon glyphicon-user"></span>'; 
									echo ' ', $user['username'] , '</a>
									<p>', $user['name'] ,' ', $user['surname'] ,'</p>
									<p>', $user['email'] ,'</p>
								</center>
							</div>
						</div>';
			if ($_SESSION['authlevel'] > 0 || $_SESSION['id'] == $id)
				echo '<div class="row">
							<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 inp">
								<button type="button" class="btn btn-primary btn-md"  data-toggle="modal" data-target="#editprofile-modal">Edit profile</button>
							</div>
						</div>
					</div>';
		}
	}
	
	function insertPostList() {
		$articles = new Articles();
		$result = $articles->getCategories();
		if ($result->num_rows > 0) {
			while($category = $result->fetch_assoc()) {
				
				$result2 = $articles->getPosts($category['id']);
				echo '<ul class="list"><h4><strong>', $category['name'] ,' </strong>';
				if ($_SESSION['authlevel'] > 0)
					echo '<a href="', htmlspecialchars($_SERVER["PHP_SELF"]) ,'?delcategoryid=', $category['id'], '"><span class="glyphicon glyphicon-remove text-danger"></span></a>';
				echo '</h4>';
				
				if ($result2->num_rows > 0) {
					while($post = $result2->fetch_assoc())
						echo '<li><a href="', htmlspecialchars($_SERVER["PHP_SELF"]) ,'?postid=', $post['id'], '">', $post['name'] ,'</a></li>';
				}
				
				echo "</ul><br>";
			}
		}
	}
	
	function insertComments($postid) {
		$articles = new Articles();
		$result = $articles->getComments($postid);
		if ($result->num_rows > 0) {
			$users = new Users();
			while($post = $result->fetch_assoc()) {
				$owner = $users->getUser($post['ownerid']);

				if ($owner) {
					echo '<li class="media">
							<div class="media-body">
								<div class="well well-lg">
									<h4 class="media-heading text-uppercase reviews">', $owner['name'] ,'</h4>
									<p class="media-date text-uppercase reviews list-inline">
										', $post['timestamp'] ,'</p>
									<p class="media-comment">
										', $post['text'] ,'
									</p>
								</div>
							</div>
						</li>';
				}
						
			}
			return true;
		}
		return false;
	}
	
	function insertPost($postid) {
		$articles = new Articles();
		$post = $articles->getPost($postid);
		if ($post) {
			echo '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 name">
                    <center><h1>', $post['name'] ,'</h1></center>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text">
				';
			if ($_SESSION['authlevel'] > 0 || $_SESSION['id'] == $post['ownerid']) {
				echo '<div class="remove_left"><a href="', htmlspecialchars($_SERVER["PHP_SELF"]) ,'?editpostid=', $post['id'], '"><span class="glyphicon glyphicon-edit text-danger"></span> </a>';
				echo '<a href="', htmlspecialchars($_SERVER["PHP_SELF"]) ,'?delpostid=', $post['id'], '"><span class="glyphicon glyphicon-remove text-danger"></span></div></a>';
				echo '<div class="remove_left">',$post['name'],'</div>';
				echo '<div class="remove_left">',$post['timestamp'],'</div>';
			}
			
			echo '<br><center>', $post['text'] ,'</center><br><br><br>
				</div>';
			
			return true;
		}
		
		return false;
	}
	
	function insertCategories($default) {
		$articles = new Articles();
		$result = $articles->getCategories();
		if ($result->num_rows > 0)
			while($cat = $result->fetch_assoc())
				if ($default == $cat['id'])
					echo '<option selected value="', $cat['id'] ,'">', $cat['name'] ,'</option>';
				else
					echo '<option value="', $cat['id'] ,'">', $cat['name'] ,'</option>';
	}
	
	function insertFooter() {
		
	}
}