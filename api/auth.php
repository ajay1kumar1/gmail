<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// Get Auth parameters //
$username = $_GET['var1'];
$password = $_GET['var2'];
 
// include database and object files
include_once('config/config.php');

 
// instantiate database
$database = new Database();
$db = $database->getConnection();

// Query for user in users table //
$sql = 'select * from users where username = "'.$username.'" and password = "'.$password.'"';

$result = $db->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    $auth = true;
} else {
    $auth = false;
}

echo json_encode(
    array("auth" => $auth)
);

