<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Edit Course</title>
</head>
<body>
	<h2>Add New Content</h2>
	<?php if(isset($_SESSION['error1'])){ echo "<h4 class='red'>{$_SESSION['error1']}</h4>"; }?>
	<fieldset>
		<form action="editcourse.php" method="post" enctype="multipart/form-data">
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
			<p><input type="checkbox" name="free"/><label for="free"> Free</label></p>
			<p><label for="topic_title">Topic: </label><input type="text" name="topic_title" size="40" maxlength="80" required/></p>
			<p><label for="topic_desc">Topic Summary: </label><textarea name="topic_desc" id="course_desc" cols="40" rows="10" placeholder="What does this course entail?"></textarea></p>
			<p><label for="video_url">Video URL: </label><input type="text" name="video_url" required autocomplete="off" /></p>
			<p><label for="file_url">File: </label><input type="file" name="file_url" /></p>
			<input type="submit" name="editcourse" value="Edit" />
			<input type="reset" value="Clear" />
		</form>
	</fieldset>
	<?php if(isset($_SESSION['error1']) && !empty($_SESSION['error1'])){
			$_SESSION['error1'] = "";
}?>
</body>
</html>