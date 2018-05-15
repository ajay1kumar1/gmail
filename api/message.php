<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");


$uid = $_GET['uid'];
$fetch =  $_GET['fetch'];

// include database and object files and Const file
include_once('config/config.php');
include_once('config/const.php');

// instantiate database
$database = new Database();
$db = $database->getConnection();

switch($fetch){
    case 'inbox':
        $sql = 'select * from messages where toid = '.$uid.' and mstatus = "inbox"'.' order by sdate desc';
        break;
    case 'sent':
        $sql = 'select * from messages where fromid = '.$uid.' and mstatus = "inbox"'.' order by sdate desc';
        break;
    case 'draft':
        $sql = 'select * from messages where fromid = '.$uid.' and mstatus = "draft"'.' order by sdate desc';
        break;
    case 'trash':
        $sql = 'select * from messages where fromid = '.$uid.' and mstatus = "trash"'.' order by sdate desc';
        break; 
    default:
        $sql = 'select * from messages where fromid = '.$uid.' and mstatus = "inbox"'.' order by sdate desc';        

}
//echo $sql;
$result = $db->query($sql);
$a = array();

if ($result->num_rows > 0) {
    
    // output data of each row
    while($row = $result->fetch_assoc()) {
        array_push($a,$row);
    }
    
} else {
   $a = 0;
}

echo json_encode(
    array("data" => $a)
);


?>