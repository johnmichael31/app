<?php 

$host = 'localhost';
$user = 'root';
$password = '';
$db_name = 'kiosk';

$conn = new mysqli($host, $user, $password, $db_name);
//Connect to database

if($conn->connect_error){
    die("Connection Failed:" . $conn->connect_error);
}

?>