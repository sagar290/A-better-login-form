
<?php  if (!isset($_POST['submit'])) {
	//if from not submitted
	//display form
	$username = (isset($_COOKIE['name'])) ? $_COOKIE['name'] : ' ';


 ?>



<html>
<head>
	<title>My profile</title>
	<style type="text/css">
		*{
			padding: 0;
			margin: 0;
			text-decoration: none;
		}
		body{
			width: 960px;
			margin:  0 auto;
		}
		
	</style>
</head>
<body>
 <form action="login.php" method="post">
 	Username: <br>
 	<input type="text" name="username" value="<?php echo $username; ?>"><br>
 	Password:<br>
 	<input type="password" name="password" ><br>
 	<input type="checkbox" name="sticky" checked>
 	Remember me <br>
 	<input type="submit" name="submit" value="Log in" >

 </form>

 </body>
</html>
<?php
//if from submitted 
//check supplie login credentials
//against database
} else{
	$username = $_POST['username'];
	$password = $_POST['password'];



	//check input
	
	if (empty($username)) {
		die("please Enter your <a href=\"login.php\">username</a> properly");
	}
	if (empty($password)) {
		die("please Enter your <a href=\"login.php\">password</a> properly");
	}
	
	//attemt to database connection 
	try {
		$pdo = new PDO('mysql:host=localhost;dbname=app','root', '');
		
	} catch (Exception $e) {
		die("ERROR: could not connect: ". $e->getMessage());
	}

	//escape special charecters in input
	 
	//check if username exists
	$sql = "SELECT username FROM users WHERE username = '$username'";
		if ($result = $pdo->query($sql)) {
		// retrieve record as associative array	
		$row = $result->fetch(PDO::FETCH_ASSOC);
		// if yes, fetch the encrypted password
		if ($row['username'] == $username) {
			$sql = "SELECT password FROM users WHERE username = '$username'";
			// encrypt the password entered into the form
			// test it against the encrypted password stored in the database
			// if the two match, the password is correct
			if ($result = $pdo->query($sql)) {
				// retrieve record as associative array
				$row = $result->fetch(PDO::FETCH_ASSOC); 
				
				if ( $row['password'] == $password) {
					// password correct
					// start a new session
					// save the username to the session
					// if required, set a cookie with the username
					// redirect the browser to the main application page
					session_start();
					$_SESSION['username'] = $username;
					if ($_POST['sticky']) {
						setcookie('name', $_POST['username'], mktime()+86400);
					}
						header('Location: profile.php');
				} else {
				echo 'You entered an incorrect password.';
				}
			} else {
			echo "ERROR: Could not execute $sql. " . print_r($pdo->errorInfo());
			}
		} else {
		echo 'You entered an incorrect username.';
		}
	} else {
		echo "ERROR: Could not execute $sql. " . print_r($pdo->errorInfo());
	}
	// close connection
	unset($pdo);
}
?>