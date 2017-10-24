<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Edit Content</title>
</head>
<body>
	<?php
		$query = "SELECT * FROM $table WHERE topic_id = $id";
		$topic_meta = mysqli_query($cxn,$query) or die("query failed!");
		$row = mysqli_fetch_assoc($topic_meta) or die("content fetch failed!");
		extract($row) or die("Extraction failed!");
		echo "<fieldset>
				<form action='edit_topic.php'>
					<p><label for='topic_title'>Topic: </label><input type='text' name='topic_title' value='$topic_title' size='40' maxlength='80' required/></p>
					<p><label for='topic_desc'>Topic Summary: </label><textarea name='topic_desc' value='$topic_desc' id='course_desc' cols='40' rows='10'></textarea></p>
					<p><label for='video_url'>Video URL: </label><input type='text' name='video_url' value='$video_url' required autocomplete='' /></p>
					<p><label for='file_url'>File: </label><input type='file' name='file_url' /></p>
					<input type='submit' name='editcourse' value='Edit' />
					<input type='reset' value='Clear' />
				</form>
			</fieldset>";
	?>
</body>
</html>