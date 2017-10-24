<?php
/*	Program : editcourse.php
**	Desc	: Adds course contents to courses' database. Allow staff to edit, add or remove course content.
*/
session_start(); /*@todo: correct repeated session_start within index.php*/
if((!isset($_SESSION['level'])) || ($_SESSION['level'] !== 2) || (!isset($_SESSION['staff_id']))){
	header("Location: index.php");
	exit();
}
?>
<?php
if($_SERVER['REQUEST_METHOD'] == "POST"){
	if(empty($_POST['topic_title'])){
		$_SESSION['error1'] = "Please enter a topic for your content<br />";
		include("editcourse.inc");
		exit();
	}
	include("misc.inc");
	//Save course to edit
	$course = trim($_POST['course']);
	//trim user topic_title
	$ttt = trim($_POST['topic_title']);
	//strip html tags and escape
	$ttt = mysqli_real_escape_string($cxn, strip_tags($ttt));
	//get string length
	$strlength = strlen($ttt);
	//check stripped string
	if($strlength < 1){
		$_SESSION['error1'] = "Please enter a topic title with valid characters<br />";
		header("Location: index.php?q=3");
		exit();
	}else{
		$topic_title = $ttt;
	}
	
	//trim topic description
	$td = trim($_POST['topic_desc']);
	//strip html tags and escape
	$td = mysqli_real_escape_string($cxn, strip_tags($td));
	//get string length
	$strlength = strlen($td);
	//check stripped string
	if($strlength < 1){
		$_SESSION['error1'] = "Please enter a topic summary with valid characters<br />";
		header("Location: index.php?q=3");
		exit();
	}else{
		$topic_desc = $td;
	}
	
	//trim video uRL
	$vu = trim($_POST['video_url']);
	//strip html tags and escape
	$vu = mysqli_real_escape_string($cxn, strip_tags($vu));
	//get string length
	$strlength = strlen($vu);
	//check stripped string
	if($strlength < 1){
		$_SESSION['error1'] = "Please enter a valid URL<br />";
		header("Location: index.php?q=3");
		exit();
	}else{
		$video_url = $vu;
	}
	
	if($_FILES['file_url']['name']){
		$file = "files/{$_FILES['file_url']['name']}";
		$temp = $_FILES['file_url']['tmp_name'];
		move_uploaded_file($temp,$file);
	}
	
	if(isset($file)){
		$query = "INSERT INTO $course VALUES(NULL,'$topic_title', '$topic_desc', '$video_url', '$file')";
		$result = mysqli_query($cxn, $query)or die(mysqli_error($cxn));
		if($result){
			$_SESSION['error1'] = "Course updated successfully.<br />";
		}else{
			$_SESSION['error1'] = "Failed to update your course $course.<br />";
			header("Location: index.php?q=3");
			exit();
		}
		if($_POST['free'] == 'on'){
			$query = "INSERT INTO free_$course VALUES(NULL,'$topic_title', '$topic_desc', '$video_url', '$file')";
			$result = mysqli_query($cxn, $query)or die(mysqli_error($cxn));
			if($result){
				$_SESSION['error1'] .= "Course parameters set<br />";
				header("Location: index.php?q=3");
				exit();
			}else{
				$_SESSION['error1'] = "Failed to update your course $course.<br />";
				header("Location: index.php?q=3");
				exit();
			}
		}
	}else{
		$query = "INSERT INTO $course VALUES(NULL, '$topic_title', '$topic_desc', '$video_url', NULL)";
		$result = mysqli_query($cxn, $query);
		if($result){
			$_SESSION['error1'] = "Course updated successfully.<br />";
		}else{
			$_SESSION['error1'] = "Failed to update your course $course.<br />";
			header("Location: index.php?q=3");
			exit();
		}
		if((isset($_POST['free'])) && ($_POST['free'] == 'on')){
				$query = "INSERT INTO free_$course VALUES(NULL, '$topic_title', '$topic_desc', '$video_url', NULL)";
			$result = mysqli_query($cxn, $query);
			if($result){
				$_SESSION['error1'] .= "Course parameters set.<br />";
				header("Location: index.php?q=3");
				exit();
			}else{
				$_SESSION['error1'] = "Failed to update your course $course.<br />";
				header("Location: index.php?q=3");
				exit();
			}
		}
	}
}
?>
<?php 
header("Location: index.php?q=3");
exit(); 
?>








































