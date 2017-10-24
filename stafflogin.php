<?php
/*	Program	: login.php
**	Desc	: Checks that users E-mail exists in the database. Checks that password entered matches the email entered.
*/
session_start();
include("misc.inc");
if($_SERVER['REQUEST_METHOD'] == 'POST'){
	// Initialize error array
	// Clean login details
	if(!empty($_POST['username'])){
		$username = mysqli_real_escape_string($cxn, trim($_POST['username']));
		$username = strip_tags($username);
	}else{
		echo "Please enter a Username";
		include ("stafflogin.inc.php");
		exit();
	}
	if(empty($_POST['password'])){
		echo "Please enter your password";
		include ("stafflogin.inc.php");
		exit();
	}else{
		$password = $_POST['password'];
	}
	// Check if email exists in database
	$query = "SELECT * FROM staff WHERE user_name = '{$username}'";
	$result = mysqli_query($cxn, $query) or die("Query failed!");
	if(mysqli_num_rows($result) == 0){//User does not exist
		echo "You are not one of our registered teachers!";
		include("stafflogin.inc.php");
		exit();
	}else{
		$query = "SELECT * FROM staff WHERE user_name = '{$username}' AND pwd = SHA1('{$password}')";
		$result = mysqli_query($cxn, $query) or die("Query Failed!");
		if(mysqli_num_rows($result) == 0){
			echo "Password you entered is incorrect";
			include("stafflogin.inc.php");
			exit();
		}else{
			while($row = mysqli_fetch_assoc($result)){
				extract($row);
				$_SESSION['staff_id'] = $staff_id;
				$_SESSION['firstname'] = $first_name;
				$_SESSION['lastname'] = $last_name;
				$_SESSION['level'] = (int)($user_level);
				header("Location: index.php");
				exit();
			}
		}
	}
}
include("stafflogin.inc.php");
?>