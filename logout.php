<?php session_start();
include_once('api/config/const.php');
$_SESSION = Array();
session_destroy();
header('location:'.BASE_URL);
exit();

?>