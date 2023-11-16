<?php
$servername = "localhost"; // Change this to your actual database host name if not using XAMPP
$username = "root"; // Change this to your actual database username
$password = ""; // Change this to your actual database password if you set one
$dbname = "davidphp350"; // Change this to your actual database name

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
