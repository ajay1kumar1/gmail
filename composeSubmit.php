<?php session_start();
//print_r($_REQUEST);
$toemail = $_POST['toemail'];
$fromid = $_POST['fromid'];
$subject = $_POST['subject'];
$message = $_POST['message'];


// include database and object files and Const file
include_once('api/config/config.php');
include_once('api/config/const.php');


$url = BASE_URL."api/api.php?toemail=".urlencode($toemail)."&fromid=".urlencode($fromid)."&subject=".urlencode($subject)."&message=".urlencode($message);
		
$client = curl_init($url);
curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
$response = curl_exec($client);

$result = json_decode($response);
//print_r($result);
//echo $result->data; 


header('location:'.BASE_URL.'?create='.$result->data);
// echo json_encode(
//     array("auth" => $auth)
// );
?>