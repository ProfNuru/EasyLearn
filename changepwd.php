<?php
/*
** Program	: changepwd.php
** Desc		: Allows staff to change their password.	
*/
session_start(); /*@todo: correct repeated session_start within index.php*/
if((!isset($_SESSION['level'])) || ($_SESSION['level'] !== 2) || (!isset($_SESSION['staff_id']))){
	header("Location: index.php");
	exit();
}
if($_SERVER['REQUEST_METHOD'] == "POST"){
	include("misc.inc");
	//strip html tags and escape
	$pw = mysqli_real_escape_string($cxn, strip_tags($_POST['password1']));
	//get string length
	$strlength = strlen($pw);
	//check stripped string
	if($strlength < 1){
		$_SESSION['pwd_msg'] = "Enter a Valid Password<br />";
		header("Location: index.php?q=6");
		exit();
	}else{
		$password = $pw;
	}
	
	//strip second password and match to first
	$pw2 = mysqli_real_escape_string($cxn, strip_tags($_POST['password2']));
	if($password !== $pw2){
		$_SESSION['pwd_msg'] = "Passwords do not match<br />";
		header("Location: index.php?q=6");
		exit();
	}else{
		$query = "UPDATE staff SET pwd = SHA1('$password') WHERE staff_id = '{$_SESSION['staff_id']}'";
		$result = mysqli_query($cxn, $query);
		if($result){
			$_SESSION['pwd_msg'] = "Password Successfully changed<br />";
			header("Location: index.php?q=6");
			exit();
		}else{
			$_SESSION['pwd_msg'] = "Failed to change password<br />";
			header("Location: index.php?q=6");
			exit();
		}
		
	}
	
}
header("Location: index.php?q=6");
exit();
?>