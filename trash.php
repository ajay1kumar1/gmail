<?php session_start();
// include database and object files and Const file
include_once('api/config/config.php');
include_once('api/config/const.php');

// instantiate database
$database = new Database();
$db = $database->getConnection();



$id= $_REQUEST['id'];

$sql = 'update messages set mstatus="trash" where id = '.$id;

$result = $db->query($sql);

header('location:'.BASE_URL);
exit();
?>