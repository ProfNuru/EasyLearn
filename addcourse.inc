<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Add New Course</title>
</head>
<body>
	<h2>Add a New Course to Teach</h2>
	<?php if(isset($_SESSION['error'])){ echo "<h4 class='red'>{$_SESSION['error']}</h4>"; }?>
	<fieldset>
		<form action="addcourse.php" method="post">
			<p><label for="course_title">Course Title: </label><input type="text" name="course_title" size="40" maxlength="50" /></p>
			<p><label for="course_desc">Course Description: </label><textarea name="course_desc" id="course_desc" cols="40" rows="10" placeholder="What does this course entail?"></textarea></p>
			<input type="submit" name="addcourse" value="Add Course" />
			<input type="reset" value="Clear" />
		</form>
	</fieldset>
</body>
<?php if(isset($_SESSION['error']) && !empty($_SESSION['error'])){
				$_SESSION['error'] = "";
}?>
</html>