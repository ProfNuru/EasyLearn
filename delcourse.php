<?php
/*	Program : delcourse.php
**	Desc	: Deletes course contents from courses' database.
*/
session_start(); /*@todo: correct repeated session_start within index.php*/
if((!isset($_SESSION['level'])) || ($_SESSION['level'] !== 2) || (!isset($_SESSION['staff_id']))){
	header("Location: index.php");
	exit();
}
if($_SERVER['REQUEST_METHOD'] == "POST"){
	$course_title = $_POST['course'];
	$s_id = $_SESSION['staff_id'];
	include("misc.inc");
	//Delete course table
	$tquery = "DROP TABLE {$course_title}";
	$tresult = mysqli_query($cxn, $tquery);
	if($tresult){
		$_SESSION['error'] = "Course deleted successfully.<br />";
		$query = "DELETE FROM courses WHERE course_title='{$course_title}' && staff_id='{$s_id}'";
		$result = mysqli_query($cxn,$query);
		if($result){
			$_SESSION['error'] .= "Now go to <a href='addcourse.php'>Add Course Course</a> page to add a new course";
		}else{
			$_SESSION['error'] = "Sorry! there was an error.<br />";
		}
	}else{
		$_SESSION['error'] = "Sorry! could not delete course<br />";
	}
	$tquery = "DROP TABLE free_{$course_title}";
	$tresult = mysqli_query($cxn, $tquery);
	if($tresult){
		$_SESSION['error'] = "Course deleted successfully.<br />";
	}else{
		$_SESSION['error'] = "Incomplete course deletion!<br />";
	}
}
header("Location: index.php?q=4");
exit();
?>