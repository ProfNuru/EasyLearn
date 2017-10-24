<?php
/*	Program	: login.php
**	Desc	: Checks that users E-mail exists in the database. Checks that password entered matches the email entered.
*/
session_start();
include("misc.inc");
if($_SERVER['REQUEST_METHOD'] == 'POST'){
	// Initialize error array
	// Clean login details
	if(filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL)){
		$email = mysqli_real_escape_string($cxn, trim($_POST['email']));
	}else{
		echo "Invalid E-mail address";
		include ("login.inc.php");
		exit();
	}
	if(empty($_POST['password'])){
		echo "Please enter your password";
		include ("login.inc.php");
		exit();
	}else{
		$password = $_POST['password'];
	}
	// Check if email exists in database
	$query = "SELECT * FROM users WHERE email = '{$email}'";
	$result = mysqli_query($cxn, $query) or die("Query failed!");
	if(mysqli_num_rows($result) == 0){//E-mail does not exist
		echo "E-mail address is not registered";
		include("login.inc.php");
		exit();
	}else{
		$query = "SELECT * FROM users WHERE email = '{$email}' AND pwd = SHA1('{$password}')";
		$result = mysqli_query($cxn, $query) or die("Query Failed!");
		if(mysqli_num_rows($result) == 0){
			echo "Password you entered is incorrect";
			include("login.inc.php");
			exit();
		}else{
			while($row = mysqli_fetch_assoc($result)){
				extract($row);
				$_SESSION['firstname'] = $first_name;
				$_SESSION['lastname'] = $last_name;
				$_SESSION['level'] = (int)($user_level);
				header("Location: index.php");
				exit();
			}
		}
	}
}
include("login.inc.php");
?>