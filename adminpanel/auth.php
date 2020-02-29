<?php 
session_start();
if($_SESSION['ADMIN_ELALA_ID'] == '')
{
	header('location:index.php');
	exit;
}
?>