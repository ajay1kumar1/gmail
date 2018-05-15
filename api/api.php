<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");


$toemail = $_GET['toemail'];
$fromid =  $_GET['fromid'];
$subject = $_GET['subject'];
$message = $_GET['message'];
// include database and object files and Const file
include_once('config/config.php');
include_once('config/const.php');

// instantiate database
$database = new Database();
$db = $database->getConnection();

 // Get to ID details //
 $sql = 'select * from users where email = "'.$toemail.'"';

 $result = $db->query($sql);
 if($row1 = $result->fetch_assoc()) {                            
     $toid = $row1["id"];                            
 }



// Query for user in users table //
$sql = "INSERT INTO messages ( fromid, toid, fromname, toname, title, body, mstatus, status, sdate) 
VALUES ( ".$fromid.", ".$toid.", 'Ajay SR', 'S SR', '".$subject."', '".$message."', 'inbox', 1, now())";

$result = $db->query($sql);
echo json_encode(
    array("data" => $result)
);


?>