<?php
/*	Program	: index.php
**	Desc	: Displays sample tutorials. Contains links to login.php and register.php
*/
session_start();
if(isset($_SESSION['firstname']) &&	isset($_SESSION['lastname']) && isset($_SESSION['level'])){
	if(isset($_SESSION['newuser'])){
		echo $_SESSION['newuser'];
	}elseif(isset($_SESSION['newstaff'])){
		echo $_SESSION['newstaff'];
	}
	if($_SESSION['level'] === 2){
		include("staffdashboard.php");
		exit();
	}elseif($_SESSION['level'] === 1){
		echo "You are logged in as a user<br />";
	}
	echo "<a href='logout.php'>Logout</a>";
}else{
	include("homepage.inc.php");
}
exit();
?>