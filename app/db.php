<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "ci_rest_api";

$conn = new mysqli($host, $user, $password, $database);

if($conn->connect_error){
    echo "Failed to connect".connect_error;
}else{
   // echo "connected successfully";
}
?>