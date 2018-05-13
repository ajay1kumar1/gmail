<?php session_start();
//print_r($_REQUEST);
$username = $_POST['username'];
$password = $_POST['password'];

// include database and object files and Const file
include_once('api/config/config.php');
include_once('api/config/const.php');

 
// instantiate database
$database = new Database();
$db = $database->getConnection();

// Query for user in users table //
$sql = 'select * from users where username = "'.$username.'" and password = "'.$password.'"';

$result = $db->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    $auth = true;
    if($row = $result->fetch_assoc()) {
        $email = $row["email"];
        $uid = $row["id"];
    }
    $_SESSION['user']= array('auth'=>true,'username' => $username,'email' => $email,'uid' => $uid);
} else {
    $auth = false;
}
header('location:'.BASE_URL);
// echo json_encode(
//     array("auth" => $auth)
// );
?>