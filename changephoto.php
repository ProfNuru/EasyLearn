<?php
/*	Program : changephoto.php
**	Desc	: Changes staff profile picture.
*/
session_start(); /*@todo: correct repeated session_start within index.php*/
include("misc.inc");
if((!isset($_SESSION['level'])) || ($_SESSION['level'] !== 2) || (!isset($_SESSION['staff_id']))){
	header("Location: index.php");
	exit();
}
if($_SERVER["REQUEST_METHOD"] == "POST" ){
	$photo_url = "staffphotos/{$_FILES['photo']['name']}";
	$temp = $_FILES['photo']['tmp_name'];
	$type = $_FILES['photo']['type'];
	$s_id = $_SESSION['staff_id'];
	move_uploaded_file($temp,$photo_url);
	
	$query = "UPDATE staff SET photo_url = '$photo_url' WHERE staff_id = '$s_id'";
	$result = mysqli_query($cxn,$query);
	if($result){
		$_SESSION['pic_change'] = "Photo changed successfully<br>";
	}else{
		$_SESSION['pic_change'] = "Unable to change photo<br>";
	}
}
header("Location: index.php?q=5");
exit();
?>
