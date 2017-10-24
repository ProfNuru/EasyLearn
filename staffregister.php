<?php
/*	Program	: staffregister.php
**	Desc	: Registers course instructors. Wrangles input data and adds into staff database.
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
		$_SESSION['msg'] .= "Empty phone field<br />";
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
	
	//trim staff about info
	$ab = trim($_POST['about']);
	//strip html tags and escape
	$ab = mysqli_real_escape_string($cxn, strip_tags($ab));
	//get string length
	$strlength = strlen($ab);
	//check stripped string
	if($strlength < 1){
		$_SESSION['msg'] .= "Illegal characters in about field<br />";
	}else{
		$about = $ab;
	}
	
	//trim staff username
	$un = trim($_POST['username']);
	//strip html tags and escape
	$un = mysqli_real_escape_string($cxn, strip_tags($un));
	//get string length
	$strlength = strlen($un);
	//check stripped string
	if($strlength < 1){
		$_SESSION['msg'] .= "Illegal Username<br />";
	}else{
		$username = $un;
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
		header("Location: staffregister.php");
		exit();
	}else{
		if(empty($_FILES['photo'])){
			$_SESSION['msg'] = "Please upload a photo of yourself";
			header("Location: staffregister.php");
			exit();
		}elseif($_FILES['photo']['tmp_name'] == 'none'){
			$_SESSION['msg'] = "File did not upload successfully. Check the file size";
			header("Location: staffregister.php");
			exit();
		}elseif(!ereg("image",$_FILES['photo']['type'])){
			$_SESSION['msg'] = "File is not a picture. Please try another file";
			header("Location: staffregister.php");
			exit();
		}else{
			//Make sure email does not already exist.
			$query = "SELECT * FROM STAFF WHERE email = '{$email}'";
			$result = mysqli_query($cxn,$query);
			if($result){
				$_SESSION['msg'] = "User with this E-mail already exists<br />";
				header("Location: staffregister.php");
				exit();
			}else{
				$photo = "staffphotos/{$_FILES['photo']['name']}";
				$temp = $_FILES['photo']['tmp_name'];
				move_uploaded_file($temp,$photo);

				$query = "INSERT INTO staff (first_name,last_name,email,phone,about,photo_url,user_name,pwd,reg_date,city,country) VALUES('{$firstname}','{$lastname}','{$email}','{$phone}','{$about}','{$photo}','{$username}',SHA1('{$password}'),NOW(),'{$city}','{$country}')";
				$result = mysqli_query($cxn,$query);
				if($result){
					$_SESSION['newstaff'] = "Welcome, $firstname";
					$_SESSION['email'] = $email;
					header("Location: thanks.php");
					exit();
				}else{
					$_SESSION['msg'] = "A problem occurred! Please try again.";
					header("Location: staffregister.php");
					exit();
				}
			}
			
		}
	}
	
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Staff Registration</title>
</head>
<body>
	<?php if(isset($_SESSION['msg']) && (strlen($_SESSION['msg']) > 0)){
		echo "<h3>{$_SESSION['msg']}</h3>";
	}
	?>
	<fieldset>
		<form action="staffregister.php" method="POST" enctype="multipart/form-data">
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
			<p><label for="about">About: </label>
			<textarea name="about" id="about" cols="30" rows="10" placeholder="Tell us who you are..."></textarea></p>
			<p><label for="photo">Photo: </label>
			<input type="file" name="photo" required /></p>
			<p><label for="username">Username: </label>
			<input type="text" name="username" size="40" maxlength="40" required /></p>
			<p><label for="email">E-mail: </label>
			<input type="text" name="email"	maxlength="50" required /></p>
			<p><label for="password">Password: </label>
			<input type="password" name="password" required/></p>
			<p><label for="password2">Confirm Password: </label>
			<input type="password" name="password2" required/></p>
			<input type="submit" name="login" value="Register" />
		</form>
	</fieldset>
</body>
</html>