<?php
//connects to database
$host = "localhost";
$dbname = "roomie";
$user = "root";
$pass = "";

$conn = new PDO("mysql:host=$host;dbname=$dbname;", $user, $pass);

if ($conn == true) {
    //echo "Website working"; 
} else {
    echo "Failed";
}

?>