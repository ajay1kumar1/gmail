<?php
include('api/config/config.php');
// instantiate database 
$database = new Database();
$db = $database->getConnection();
print_r($db);
?>