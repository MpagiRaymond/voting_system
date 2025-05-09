<?php
$dbservername = "localhost";
$dbuser = "root";
$dbpassword = "";
$dbname = "votings";

$conn = mysqli_connect($dbservername, $dbuser, $dbpassword, $dbname);
if($conn->connect_error){
    die("Connection failed {$conn->connect_error}");
}
