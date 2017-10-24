<?php
$host = 'localhost';
$user = 'web';
$pwd = 'nuru';
$db = 'wassce_library';

$cxn = mysqli_connect($host,$user,$pwd,$db) or die('Database connection failed!');
mysqli_set_charset($cxn, 'utf8');
?>