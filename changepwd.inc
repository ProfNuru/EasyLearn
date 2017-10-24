<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Change Password</title>
</head>
<body>
	<?php
		if(isset($_SESSION['pwd_msg']) && !empty($_SESSION['pwd_msg'])){
			echo "<h4>{$_SESSION['pwd_msg']}</h4>";
		}
	?>
	<fieldset>
		<form action="changepwd.php" method="post">
			<p><label for="password">Password: </label>
			<input type="password" name="password1" required/></p>
			<p><label for="password2">Confirm Password: </label>
			<input type="password" name="password2" required/></p>
			<input type="submit" name="login" value="Change" />
		</form>
	</fieldset>
	<?php if(isset($_SESSION['pwd_msg']) && !empty($_SESSION['pwd_msg'])){
			$_SESSION['pwd_msg'] = "";
}?>
</body>
</html>