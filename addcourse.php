<?php
/*	Program	: addcourse.php
**	Desc	: Allows staff to add new course to the courses database. Creates a new table for course contents.
*/
session_start(); /*@todo: correct repeated session_start within index.php*/
if((!isset($_SESSION['level'])) || ($_SESSION['level'] !== 2) || (!isset($_SESSION['staff_id']))){
	header("Location: index.php");
	exit();
}
if($_SERVER['REQUEST_METHOD'] == "POST"){
	$s_id = $_SESSION['staff_id'];	
	if(empty($_POST['course_title'])){
		$_SESSION['error'] = "Please enter a course title<br />";
		header("Location: index.php?q=2");
		exit();
	}
	
	include("misc.inc");
	//trim user course_title
	$ctt = trim($_POST['course_title']);
	//strip html tags and escape
	$ctt = mysqli_real_escape_string($cxn, strip_tags($ctt));
	//get string length
	$strlength = strlen($ctt);
	//check stripped string
	if($strlength < 1){
		$_SESSION['error'] = "Illegal character(s) in course title<br />";
		header("Location: index.php?q=2");
		exit();
	}else{
		$course_title = strtolower($ctt);
		
	}
	
	if(empty($_POST['course_desc'])){
		$_SESSION['error'] = "Please enter a course description<br />";
		header("Location: index.php?q=2");
		exit();
	}
	//trim user course_desc
	$cd = trim($_POST['course_desc']);
	//strip html tags and escape
	$cd = mysqli_real_escape_string($cxn, strip_tags($cd));
	//get string length
	$strlength = strlen($cd);
	//check stripped string
	if($strlength < 1){
		$_SESSION['error'] = "Illegal character(s) in course description<br />";
		header("Location: index.php?q=2");
		exit();
	}else{
		$course_desc = $cd;
	}
	//Create new course table
	$tquery = "CREATE TABLE $course_title (topic_id MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY, topic_title VARCHAR(80) NOT NULL, topic_desc LONGTEXT NOT NULL, video_url VARCHAR(200) NOT NULL, file_url VARCHAR(200) NULL)";
	$tresult = mysqli_query($cxn, $tquery);
	if($tresult){
		$_SESSION['error'] = "Course created successfully.<br />";
		$query = "INSERT INTO courses (course_title, staff_id, course_description) VALUES('{$course_title}','{$s_id}','{$course_desc}')";
		$result = mysqli_query($cxn,$query);
		if($result){
			$_SESSION['error'] .= "Course added successfully!<br />";
			
			$tquery = "CREATE TABLE free_$course_title (topic_id MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY, topic_title VARCHAR(80) NOT NULL, topic_desc LONGTEXT NOT NULL, video_url VARCHAR(200) NOT NULL, file_url VARCHAR(200) NULL)";
			$tresult = mysqli_query($cxn, $tquery);
			if($tresult){
				$_SESSION['error'] .= "Course parameters successfully created!<br />";
			}else{
				$_SESSION['error'] = "Course creation not completed.<br />";
			}
			
			$_SESSION['error'] .= "<p><a href='editcourse.php'>Edit Course</a></p><p><a href='delcourse.php'>Remove Course</a></p>";
		}else{
			$_SESSION['error'] = "Sorry! there was an error.<br />";
		}
	}else{
		$_SESSION['error'] = "Sorry! could not create course<br />";
	}
}
header("Location: index.php?q=2");
?>
