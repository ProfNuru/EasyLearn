<?php
/* Program	: thanks.php
** Desc		: Acknowledges user registeration and links to login page
*/
session_start();
if(isset($_SESSION['newstaff'])){
	echo "Your Registeration was successful<br />Login to start teaching now ";
	echo "<a href='login.php'>Login</a>";
	exit();
}
echo "Your Registeration was successful<br />Thank you for studying with us";
echo "<a href='login.php'>Login</a>";
?>