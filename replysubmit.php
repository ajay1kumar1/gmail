<?php session_start();
print_r($_REQUEST);
$fromemail = $_POST['fromemail'];
$toemail = $_POST['toemail'];
$subject = $_POST['title'];
$message = $_POST['amessage'];
$toid = $_POST['toid'];
$fromid = $_POST['fromid'];



// include database and object files and Const file
include_once('api/config/config.php');
include_once('api/config/const.php');

 
// instantiate database
$database = new Database();
$db = $database->getConnection();


$url = BASE_URL."api/reply.php?toemail=".urlencode($toemail)."&toid=".urlencode($toid)."&fromemail=".urlencode($fromemail)."&fromid=".urlencode($fromid)."&subject=".urlencode($subject)."&message=".urlencode($message);
		
$client = curl_init($url);
curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
$response = curl_exec($client);

$result = json_decode($response);
//print_r($result);
//echo $result->data; 


header('location:'.BASE_URL.'?create='.$result->data);


?>