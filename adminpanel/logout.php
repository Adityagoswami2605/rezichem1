<?php 
session_start();
unset($_SESSION['ADMIN_ELALA_ID']);
unset($_SESSION['ADMIN_ELALA_USERNAME']);
unset($_SESSION['ADMIN_ELALA_EMAIL']);

header('location:index.php');
exit;
?>
