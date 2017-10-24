<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Change Profile Photo</title>
</head>
<body>
	<?php if(isset($_SESSION['pic_change'])){ echo "<h4 class='red'>{$_SESSION['pic_change']}</h4>"; }?>
	<?php
		include("misc.inc");
		$query = "SELECT * FROM staff WHERE staff_id = '{$_SESSION['staff_id']}'";
		$result = mysqli_query($cxn,$query);
		if($result){
			while($row = mysqli_fetch_assoc($result)){
				echo "<div class='profile-pic'><img src='{$row['photo_url']}' width='200px'/></div>";
			}
		}
	?>
	<fieldset>
		<form action="changephoto.php" method="post" enctype="multipart/form-data">
			<p><label for="photo">Photo: </label><input type="file" name="photo"></p>
			<p><input type="submit" name="changephoto" value="Change"></p>
		</form>
	</fieldset>
	<?php if(isset($_SESSION['pic_change']) && !empty($_SESSION['pic_change'])){
				$_SESSION['pic_change'] = "";
}?>
</body>
</html>