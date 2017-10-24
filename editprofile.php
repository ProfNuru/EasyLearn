<?php
/*	Program : editprofile.php
**	Desc	: Allows staff to edit their profile information.
*/
session_start(); /*@todo: correct repeated session_start within index.php*/
if($_SERVER['REQUEST_METHOD'] == 'POST'){
	include("misc.inc");
	$_SESSION['msg'] = "";
	//trim user username
	$un = trim($_POST['username']);
	//strip html tags and escape
	$un = mysqli_real_escape_string($cxn, strip_tags($un));
	//get string length
	$strlength = strlen($un);
	//check stripped string
	if($strlength < 1){
		$_SESSION['msg'] .= "Illegal first name<br />";
	}else{
		$username = $un;
		$query = "UPDATE staff SET user_name = '$username' WHERE staff_id = '{$_SESSION['staff_id']}'";
		$result = mysqli_query($cxn, $query) or die("Query Failed!");
	}
	//trim and normalize user phone number
	$ph = trim($_POST['phone_num']);
	$phone = preg_replace('/\D+/','',$ph);
	$query = "UPDATE staff SET phone = '$phone' WHERE staff_id = '{$_SESSION['staff_id']}'";
	$result = mysqli_query($cxn, $query) or die("Query Failed!");
	
	//trim user city name
	$ct = trim($_POST['city_name']);
	//strip html tags and escape
	$ct = mysqli_real_escape_string($cxn, strip_tags($ct));
	//get string length
	$strlength = strlen($ct);
	//check stripped string
	if($strlength < 1){
		$_SESSION['msg'] .= "Illegal city name<br />";
	}else{
		$city = $ct;
		$query = "UPDATE staff SET city = '$city' WHERE staff_id = '{$_SESSION['staff_id']}'";
		$result = mysqli_query($cxn, $query) or die("Query Failed!");
	}
	
	//trim user country name
	$cy = trim($_POST['country_name']);
	//strip html tags and escape
	$cy = mysqli_real_escape_string($cxn, strip_tags($cy));
	//get string length
	$strlength = strlen($cy);
	//check stripped string
	if($strlength < 1){
		$_SESSION['msg'] .= "Illegal country name<br />";
	}else{
		$country = $cy;
		$query = "UPDATE staff SET country = '$country' WHERE staff_id = '{$_SESSION['staff_id']}'";
		$result = mysqli_query($cxn, $query) or die("Query Failed!");
	}
	
	//trim staff about info
	$ab = trim($_POST['about_staff']);
	//strip html tags and escape
	$ab = mysqli_real_escape_string($cxn, strip_tags($ab));
	//get string length
	$strlength = strlen($ab);
	//check stripped string
	if($strlength < 1){
		$_SESSION['msg'] .= "Illegal characters in about field<br />";
	}else{
		$about = $ab;
		$query = "UPDATE staff SET about = '$about' WHERE staff_id = '{$_SESSION['staff_id']}'";
		$result = mysqli_query($cxn, $query) or die("Query Failed!");
	}
	
	//validate E-mail address
	if(filter_var(trim($_POST['email_addr']), FILTER_VALIDATE_EMAIL)){
		$email = mysqli_real_escape_string($cxn, trim($_POST['email_addr']));
		$query = "UPDATE staff SET email = '$email' WHERE staff_id = '{$_SESSION['staff_id']}'";
		$result = mysqli_query($cxn, $query) or die("Query Failed!");
	}else{
		$_SESSION['msg'] .= "Invalid E-mail address<br />";
	}
	
	if(empty($_SESSION['msg'])){
		$_SESSION['msg'] = "Your information has been updated successfully<br />";
	}
	header("Location: index.php?q=1");
	exit();
}
/*include("editprofile.inc");*/
?>
