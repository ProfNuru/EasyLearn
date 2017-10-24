<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Delete Course</title>
</head>
<body>
	<h2>Delete Course</h2>
	<?php if(isset($_SESSION['error'])){ echo "<h4 class='red'>{$_SESSION['error']}</h4>"; }?>
	<fieldset>
		<form action="delcourse.php" method="post" enctype="multipart/form-data">
			<p><label for="course">Course: </label><select name="course">
			<?php
				include("misc.inc");
				$query = "SELECT * FROM courses WHERE staff_id = '{$_SESSION['staff_id']}'";
				$results = mysqli_query($cxn, $query);
				while($row = mysqli_fetch_assoc($results)){
					extract($row);
					echo "<option value='$course_title'>$course_title</option>";
				}
			?>
			</select></p>
			<input type="submit" name="delcourse" value="Remove" />
			<input type="reset" value="Clear" />
		</form>
	</fieldset>
</body>
<?php if(isset($_SESSION['error']))$_SESSION['error']=""?>
</html>