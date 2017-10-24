<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Edit your Profile</title>
</head>
<body>
	<?php 
	
	include("misc.inc");
	$query = "SELECT * FROM staff WHERE staff_id = '{$_SESSION['staff_id']}'";
	$result = mysqli_query($cxn, $query) or die("Query Failed!");
	while($row = mysqli_fetch_assoc($result)){
		extract($row);
	}
	
	if(isset($_SESSION['msg']) && !empty($_SESSION['msg'])){
			echo "<h4>{$_SESSION['msg']}</h4>";
	}?>
	<p><a href="index.php?q=5">Change Photo</a></p>
	<p><a href="index.php?q=6">Change Password</a></p>

	<fieldset>
		<form action="editprofile.php" method="POST" enctype="multipart/form-data">
			<p><label for="username">Username: </label>
			<input type="text" name="username" value="<?php echo $user_name ?>" size="40" maxlength="40" required /></p>
			<p><label for="phone_num">Phone: </label>
			<input type="text" name="phone_num" value="<?php echo $phone ?>" required /></p>
			<p><label for="city_name">City: </label>
			<input type="text" name="city_name" value="<?php echo $city ?>" required /></p>
			<p><label for="country_name">Country: </label>
			<input type="text" name="country_name" value="<?php echo $country ?>" required /></p>
			<p><label for="about_staff">About: </label>
			<textarea name="about_staff" id="about" cols="30" rows="10"><?php echo $about ?></textarea></p>
			<p><label for="email_addr">E-mail: </label>
			<input type="text" name="email_addr"	value="<?php echo $email ?>" maxlength="50" required /></p>
			<input type="submit" name="update" value="Update" />
			<input type="reset" value="Reset" />
		</form>
	</fieldset>
	<?php if(isset($_SESSION['msg']) && !empty($_SESSION['msg'])){
				$_SESSION['msg'] = "";
	}?>
</body>
</html>