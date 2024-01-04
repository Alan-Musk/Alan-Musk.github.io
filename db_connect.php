<?php
$servername = "localhost";
$username = "root"; // or your database username
$password = "fanzf12345"; // or your database password
$dbname = "zhang_s1546489_fan";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>
