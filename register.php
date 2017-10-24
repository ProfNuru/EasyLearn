<?php
/*	Program	: register.php
**	Desc	: Registers users. Wrangles input data and adds into user database.
*/
session_start();
include("misc.inc");
if($_SERVER['REQUEST_METHOD'] == 'POST'){
	$_SESSION['msg'] = "";
	//trim user firstname
	$fn = trim($_POST['firstname']);
	//strip html tags and escape
	$fn = mysqli_real_escape_string($cxn, strip_tags($fn));
	//get string length
	$strlength = strlen($fn);
	//check stripped string
	if($strlength < 1){
		$_SESSION['msg'] .= "Illegal first name<br />";
	}else{
		$firstname = $fn;
	}
	
	//trim user lastname
	$ln = trim($_POST['lastname']);
	//strip html tags and escape
	$ln = mysqli_real_escape_string($cxn, strip_tags($ln));
	//get string length
	$strlength = strlen($ln);
	//check stripped string
	if($strlength < 1){
		$_SESSION['msg'] .= "Illegal last name<br />";
	}else{
		$lastname = $ln;
	}
	
	//check if phone empty or not
	if(empty($_POST['phone'])){
		$phone = $_POST['phone'];
	}elseif(!empty($_POST['phone'])){
		//strip out everything that is not a number.
		$phone = preg_replace('/\D+/','',$_POST['phone']);
	}
	
	//trim user city name
	$ct = trim($_POST['city']);
	//strip html tags and escape
	$ct = mysqli_real_escape_string($cxn, strip_tags($ct));
	//get string length
	$strlength = strlen($ct);
	//check stripped string
	if($strlength < 1){
		$_SESSION['msg'] .= "Illegal city name<br />";
	}else{
		$city = $ct;
	}
	
	//trim user country name
	$cy = trim($_POST['country']);
	//strip html tags and escape
	$cy = mysqli_real_escape_string($cxn, strip_tags($cy));
	//get string length
	$strlength = strlen($cy);
	//check stripped string
	if($strlength < 1){
		$_SESSION['msg'] .= "Illegal country name<br />";
	}else{
		$country = $cy;
	}
	
	//validate E-mail address
	if(filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL)){
		$email = mysqli_real_escape_string($cxn, trim($_POST['email']));
	}else{
		$_SESSION['msg'] .= "Invalid E-mail address<br />";
	}
	
	//strip html tags and escape
	$pw = mysqli_real_escape_string($cxn, strip_tags($_POST['password']));
	//get string length
	$strlength = strlen($pw);
	//check stripped string
	if($strlength < 1){
		$_SESSION['msg'] .= "Illegal password character(s)<br />";
	}else{
		$password = $pw;
	}
	
	//strip second password and match to first
	$pw2 = mysqli_real_escape_string($cxn, strip_tags($_POST['password2']));
	if($password !== $pw2){
		$_SESSION['msg'] .= "Passwords do not match<br />";
	}
	if(strlen($_SESSION['msg']) > 0){
		header("Location: register.php");
		exit();
	}
	$user_level = 1;
	$query = "INSERT INTO users (first_name,last_name,email,pwd,phone,user_level,reg_date,city,country) VALUES('{$firstname}','{$lastname}','{$email}',SHA1('{$password}'),'{$phone}','{$user_level}',NOW(),'{$city}','{$country}')";
	$result = mysqli_query($cxn,$query);
	if($result){
		header("Location: thanks.php");
		exit();
	}else{
		$_SESSION['msg'] = "A problem occurred! Please try again.";
		header("Location: register.php");
		exit();
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>User Registration</title>
</head>
<body>
	<?php if(isset($_SESSION['msg']) && (strlen($_SESSION['msg']) > 0)){
		echo "<h3>{$_SESSION['msg']}</h3>";
	}
	?>
	<fieldset>
		<form action="register.php" method="POST">
			<p><label for="firstname">First Name: </label>
			<input type="text" name="firstname" size="40" maxlength="30" required /></p>
			<p><label for="lastname">Last Name: </label>
			<input type="text" name="lastname" size="40" maxlength="40" required /></p>
			<p><label for="phone">Phone: </label>
			<input type="text" name="phone" required /></p>
			<p><label for="city">City: </label>
			<input type="text" name="city" required /></p>
			<p><label for="country">Country: </label>
			<input type="text" name="country" required /></p>
			<p><label for="email">E-mail: </label>
			<input type="text" name="email"	maxlength="50" required /></p>
			<p><label for="password">Password: </label>
			<input type="password" name="password" required/></p>
			<p><label for="password2">Confirm Password: </label>
			<input type="password" name="password2" required/></p>
			<input type="submit" name="login" value="Login" />
		</form>
	</fieldset>
</body>
</html>