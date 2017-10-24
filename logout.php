<?php
/*	Program	: logout.php
**	Desc	: logs users out. Destroys all sessions.
*/
session_start();
$_SESSION = array();
session_destroy();
header("Location: index.php");
exit();
?>